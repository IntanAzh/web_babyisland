<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;

class OrderController extends ApiController
{
    /**
     * Display a listing of orders for the authenticated user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $orders = $request->user()->orders()
            ->with(['product', 'transaction'])
            ->latest()
            ->paginate(10);
            
        return $this->successResponse(
            OrderResource::collection($orders)->response()->getData(true),
            'Orders retrieved successfully'
        );
    }

    /**
     * Store a newly created order.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'address' => 'required|string',
            'notes' => 'nullable|string',
            'courier' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422, $validator->errors());
        }

        $product = Product::findOrFail($request->product_id);
        
        // Check if product is in stock
        if ($product->stock < $request->qty) {
            return $this->errorResponse('Product out of stock or insufficient quantity', 422);
        }
        
        // Calculate rental duration in days
        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $days = $startDate->diff($endDate)->days;
        
        if ($days <= 0) {
            return $this->errorResponse('End date must be at least one day after start date', 422);
        }
        
        // Calculate total price
        $totalPrice = $product->calculateRentalPrice($days) * $request->qty;
        
        // Create order
        $order = Order::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice,
            'address' => $request->address,
            'notes' => $request->notes,
            'status' => 'pending',
            'courier' => $request->courier,
        ]);
        
        // Reduce product stock
        $product->stock -= $request->qty;
        $product->save();
        
        return $this->successResponse(
            new OrderResource($order->load('product')),
            'Order created successfully'
        );
    }

    /**
     * Display the specified order.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $order = Order::where('user_id', $request->user()->id)
            ->with(['product', 'transaction'])
            ->find($id);
        
        if (!$order) {
            return $this->errorResponse('Order not found', 404);
        }
        
        return $this->successResponse(
            new OrderResource($order),
            'Order retrieved successfully'
        );
    }

    /**
     * Update the specified order.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $order = Order::where('user_id', $request->user()->id)->find($id);
        
        if (!$order) {
            return $this->errorResponse('Order not found', 404);
        }
        
        // Only allow updating if order is pending
        if ($order->status !== 'pending') {
            return $this->errorResponse('Cannot update order - status is not pending', 422);
        }
        
        $validator = Validator::make($request->all(), [
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'courier' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422, $validator->errors());
        }
        
        // Update only specific fields
        $order->update($request->only([
            'address',
            'notes',
            'courier',
        ]));
        
        return $this->successResponse(
            new OrderResource($order->load('product')),
            'Order updated successfully'
        );
    }

    /**
     * Remove the specified order.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $order = Order::where('user_id', $request->user()->id)->find($id);
        
        if (!$order) {
            return $this->errorResponse('Order not found', 404);
        }
        
        // Only allow cancellation if order is pending
        if ($order->status !== 'pending') {
            return $this->errorResponse('Cannot cancel order - status is not pending', 422);
        }
        
        // Return product stock
        $product = $order->product;
        $product->stock += $order->qty;
        $product->save();
        
        // Delete the order
        $order->delete();
        
        return $this->successResponse(
            null,
            'Order cancelled successfully'
        );
    }
}