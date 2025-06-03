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
        $this->middleware(['auth', 'admin'])->except(['index', 'show', 'showDetail', 'catalog', 'byCategory']);
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

    /**
     * Display the product details to customers
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetail($id)
    {
        // Find the product by ID or return 404 if not found
        $product = Product::findOrFail($id);
        
        // Calculate rental prices based on different durations
        $rentalPrices = [
            '1_week' => [
                'days' => 7,
                'total' => $product->calculateRentalPrice(7),
                'per_day' => $product->calculateRentalPrice(7) / 7
            ],
            '2_weeks' => [
                'days' => 14,
                'total' => $product->calculateRentalPrice(14),
                'per_day' => $product->calculateRentalPrice(14) / 14
            ],
            '3_weeks' => [
                'days' => 21,
                'total' => $product->calculateRentalPrice(21),
                'per_day' => $product->calculateRentalPrice(21) / 21
            ],
            '4_weeks' => [
                'days' => 28,
                'total' => $product->calculateRentalPrice(28),
                'per_day' => $product->calculateRentalPrice(28) / 28
            ],
        ];
        
        $title = $product->name;
        
        return view('produk', compact('product', 'rentalPrices', 'title'));
    }
    
    /**
     * Display catalog of products to customers
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function catalog(Request $request)
    {
        $query = Product::query()->with('category');
        
        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Filter by search term if provided
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Sort products
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }
        
        // Get the products with pagination
        $products = $query->where('stock', '>', 0)->paginate(12);
        $categories = Category::all();
        
        $title = 'Katalog Produk';
        
        return view('catalog', compact('products', 'categories', 'title'));
    }
    
    /**
     * Show products by category to customers
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function byCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = Product::where('category_id', $categoryId)
            ->where('stock', '>', 0)
            ->latest()
            ->paginate(12);
        $categories = Category::all();
        
        $title = 'Kategori: ' . $category->name;
        
        return view('catalog', compact('products', 'categories', 'category', 'title'));
    }
}
