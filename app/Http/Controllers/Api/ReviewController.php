<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use Illuminate\Support\Facades\Validator;

class ReviewController extends ApiController
{
    /**
     * Get reviews for a specific product.
     *
     * @param int $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductReviews($productId)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }
        
        $reviews = Review::with('user')
            ->where('product_id', $productId)
            ->latest()
            ->paginate(10);
            
        return $this->successResponse(
            ReviewResource::collection($reviews)->response()->getData(true),
            'Product reviews retrieved successfully'
        );
    }

    /**
     * Store a newly created review.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422, $validator->errors());
        }

        // Check if user has purchased/rented this product before
        $hasOrdered = Order::where('user_id', $request->user()->id)
            ->where('product_id', $request->product_id)
            ->where('status', 'completed')
            ->exists();
            
        if (!$hasOrdered) {
            return $this->errorResponse('You can only review products you have purchased/rented', 403);
        }
        
        // Check if user has already reviewed this product
        $existingReview = Review::where('user_id', $request->user()->id)
            ->where('product_id', $request->product_id)
            ->first();
            
        if ($existingReview) {
            return $this->errorResponse('You have already reviewed this product', 422);
        }
        
        // Create review
        $review = Review::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        return $this->successResponse(
            new ReviewResource($review->load(['user', 'product'])),
            'Review created successfully'
        );
    }

    /**
     * Update the specified review.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $review = Review::where('user_id', $request->user()->id)->find($id);
        
        if (!$review) {
            return $this->errorResponse('Review not found', 404);
        }
        
        $validator = Validator::make($request->all(), [
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|min:5',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422, $validator->errors());
        }
        
        // Update review
        $review->update($request->only([
            'rating',
            'comment',
        ]));
        
        return $this->successResponse(
            new ReviewResource($review->load(['user', 'product'])),
            'Review updated successfully'
        );
    }

    /**
     * Remove the specified review.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $review = Review::where('user_id', $request->user()->id)->find($id);
        
        if (!$review) {
            return $this->errorResponse('Review not found', 404);
        }
        
        // Delete the review
        $review->delete();
        
        return $this->successResponse(
            null,
            'Review deleted successfully'
        );
    }
}