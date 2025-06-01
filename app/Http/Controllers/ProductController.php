<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->except(['index', 'show']);
    }

    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(12);
        $title = 'Product';
        return view('admin.product.index', compact('products', 'title'));
    }

    public function create()
    {
        $categories = Category::all();
        $title = 'Add Product';
        return view('admin.product.create', compact('categories', 'title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'required|string|unique:products,sku',
            'brand' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        // $gambar = $request->file('gambar')->store('product', 'public');

        Product::create([
            'name' => $validated['name'],
            'user_id' => auth()->id(),
            'sku' => $validated['sku'],
            'brand' => $validated['brand'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
            'image' => $validated['image']
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $title = 'Edit Product';
        return view('admin.product.edit', compact('product', 'categories', 'title'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'sku' => 'required',
            'brand' => 'required',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // if ($request->hasFile('image')) {
        //     // Storage::disk('public')->delete($product->gambar);
        //     $validated['image'] = $request->file('image')->store('product', 'public');
        // }

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'sku' => $validated['sku'],
            'brand' => $validated['brand'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
            // 'image' => $validated['image'] ?? $product->gambar
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        // Storage::disk('public')->delete($product->gambar);
        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil dihapus');
    }
}
