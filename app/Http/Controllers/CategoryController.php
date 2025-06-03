<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(12);
        $activeCategory = null;
        
        return view('category', [
            'title' => 'All Categories',
            'categories' => $categories,
            'products' => $products,
            'activeCategory' => $activeCategory
        ]);
    }
    
    public function show($slug)
    {
        $categories = Category::all();
        $activeCategory = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $activeCategory->id)->paginate(12);
        
        return view('category', [
            'title' => $activeCategory->name,
            'categories' => $categories,
            'products' => $products,
            'activeCategory' => $activeCategory
        ]);
    }
}
