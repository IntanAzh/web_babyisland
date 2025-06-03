<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->except(['index', 'show']);
    }

    public function adminIndex()
    {
        $title = 'Category Management';
        $categories = Category::withCount('product')->paginate(10);
        return view('admin.category.index', compact('categories', 'title'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories,slug|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $kategori = Category::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'deskripsi' => $validated['description'] ?? null,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Category $kategori)
    {
        $category = $kategori; // Rename variable to match the view expectations
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $kategori)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $kategori->id,
            'slug' => 'required|max:255|unique:categories,slug,' . $kategori->id,
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048'
        ]);

        $data = [
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'] ?? null,
        ];

        // Handle image update if new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($kategori->image && file_exists(storage_path('app/public/' . $kategori->image))) {
                unlink(storage_path('app/public/' . $kategori->image));
            }
            
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Category $kategori)
    {
        // Check if category has associated products
        if ($kategori->product()->exists()) {
            return back()->with('error', 'Cannot delete category with associated products');
        }

        // Delete the category image if it exists
        if ($kategori->image && file_exists(storage_path('app/public/' . $kategori->image))) {
            unlink(storage_path('app/public/' . $kategori->image));
        }

        // Delete the category
        $kategori->delete();
        
        // Redirect with success message
        return redirect()->route('admin.kategori.index')
            ->with('success', 'Category deleted successfully');
    }
}
