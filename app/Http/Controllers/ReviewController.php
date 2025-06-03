<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Pemesanan;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Submit a general system review or product review
     */
    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:500',
            'product_id' => 'nullable|exists:products,id',
            'order_id' => 'nullable|exists:orders,id'
        ]);

        // Create a new review
        $review = new Review();
        $review->user_id = Auth::id();
        $review->rating = $validated['rating'];
        $review->comment = $validated['ulasan'];

        // If product_id is provided, attach it to the review
        if ($request->has('product_id')) {
            $review->product_id = $validated['product_id'];
        } else {
            // Get the first product as default for system review
            // This can be replaced with a specific product for system reviews if needed
            $product = Product::first(); 
            $review->product_id = $product->id;
        }

        $review->save();

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas ulasan Anda'
        ]);
    }
}
