<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;

class ProductController extends ApiController
{
    /**
     * Display a listing of products.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        // Filter by category if provided
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        // Search by name or description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Sort products
        if ($request->has('sort')) {
            $sortField = 'created_at';
            $sortDirection = 'desc';
            
            if ($request->sort === 'price_asc') {
                $sortField = 'price';
                $sortDirection = 'asc';
            } elseif ($request->sort === 'price_desc') {
                $sortField = 'price';
                $sortDirection = 'desc';
            } elseif ($request->sort === 'newest') {
                $sortField = 'created_at';
                $sortDirection = 'desc';
            } elseif ($request->sort === 'oldest') {
                $sortField = 'created_at';
                $sortDirection = 'asc';
            }
            
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->latest(); // Default sorting by latest
        }
        
        $perPage = $request->per_page ?? 12;
        $products = $query->paginate($perPage);
        
        return $this->successResponse(
            ProductResource::collection($products)->response()->getData(true),
            'Products retrieved successfully'
        );
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::with(['category', 'review'])->find($id);
        
        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }
        
        return $this->successResponse(
            new ProductResource($product),
            'Product retrieved successfully'
        );
    }
}