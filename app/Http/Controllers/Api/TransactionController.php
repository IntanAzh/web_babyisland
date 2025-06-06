<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TransactionController extends ApiController
{
    /**
     * Display a listing of transactions for authenticated user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $transactions = Transaction::whereHas('order', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })->with('order')->latest()->paginate(10);
        
        return $this->successResponse(
            TransactionResource::collection($transactions)->response()->getData(true),
            'Transactions retrieved successfully'
        );
    }

    /**
     * Store a newly created transaction.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'bank_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422, $validator->errors());
        }

        // Check if order belongs to user
        $order = Order::where('id', $request->order_id)
            ->where('user_id', $request->user()->id)
            ->first();
            
        if (!$order) {
            return $this->errorResponse('Order not found', 404);
        }
        
        // Check if transaction already exists for this order
        if (Transaction::where('order_id', $request->order_id)->exists()) {
            return $this->errorResponse('Transaction already exists for this order', 422);
        }
        
        // Generate invoice number
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . rand(1000, 9999);
        
        // Store the payment proof image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('transactions', 'public');
        }
        
        // Create transaction
        $transaction = Transaction::create([
            'order_id' => $request->order_id,
            'bank_name' => $request->bank_name,
            'owner_name' => $request->owner_name,
            'account_number' => $request->account_number,
            'invoice' => $invoiceNumber,
            'status' => 'pending',
            'image' => $imagePath,
        ]);
        
        // Update order status to processing
        $order->status = 'process';
        $order->save();
        
        return $this->successResponse(
            new TransactionResource($transaction->load('order')),
            'Transaction created successfully'
        );
    }

    /**
     * Display the specified transaction.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $transaction = Transaction::with('order')->find($id);
        
        if (!$transaction) {
            return $this->errorResponse('Transaction not found', 404);
        }
        
        // Check if transaction belongs to user
        if ($transaction->order->user_id !== $request->user()->id) {
            return $this->errorResponse('Unauthorized', 403);
        }
        
        return $this->successResponse(
            new TransactionResource($transaction),
            'Transaction retrieved successfully'
        );
    }

    /**
     * Update the specified transaction.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::with('order')->find($id);
        
        if (!$transaction) {
            return $this->errorResponse('Transaction not found', 404);
        }
        
        // Check if transaction belongs to user
        if ($transaction->order->user_id !== $request->user()->id) {
            return $this->errorResponse('Unauthorized', 403);
        }
        
        // Only allow updating if transaction is pending
        if ($transaction->status !== 'pending') {
            return $this->errorResponse('Cannot update transaction - status is not pending', 422);
        }
        
        $validator = Validator::make($request->all(), [
            'bank_name' => 'nullable|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422, $validator->errors());
        }
        
        // Update transaction
        $transaction->update($request->only([
            'bank_name',
            'owner_name',
            'account_number',
        ]));
        
        return $this->successResponse(
            new TransactionResource($transaction),
            'Transaction updated successfully'
        );
    }

    /**
     * Upload payment proof for a transaction.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadPaymentProof(Request $request, $id)
    {
        $transaction = Transaction::with('order')->find($id);
        
        if (!$transaction) {
            return $this->errorResponse('Transaction not found', 404);
        }
        
        // Check if transaction belongs to user
        if ($transaction->order->user_id !== $request->user()->id) {
            return $this->errorResponse('Unauthorized', 403);
        }
        
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422, $validator->errors());
        }
        
        // Delete old image if exists
        if ($transaction->image && Storage::disk('public')->exists($transaction->image)) {
            Storage::disk('public')->delete($transaction->image);
        }
        
        // Store the new payment proof image
        $imagePath = $request->file('image')->store('transactions', 'public');
        
        // Update transaction
        $transaction->image = $imagePath;
        $transaction->save();
        
        return $this->successResponse(
            new TransactionResource($transaction),
            'Payment proof uploaded successfully'
        );
    }
}