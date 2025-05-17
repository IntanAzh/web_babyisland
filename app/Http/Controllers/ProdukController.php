<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->except(['index', 'show']);
    }

    public function index()
    {
        $products = Produk::with('kategori')
            ->latest()
            ->paginate(12);
        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $categories = Kategori::all();
        return view('produk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $gambar = $request->file('gambar')->store('produk', 'public');

        Produk::create([
            'nama' => $validated['nama'],
            'slug' => Str::slug($validated['nama']),
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'stok' => $validated['stok'],
            'kategori_id' => $validated['kategori_id'],
            'gambar' => $gambar
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $categories = Kategori::all();
        return view('produk.edit', compact('produk', 'categories'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($produk->gambar);
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update([
            'nama' => $validated['nama'],
            'slug' => Str::slug($validated['nama']),
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'stok' => $validated['stok'],
            'kategori_id' => $validated['kategori_id'],
            'gambar' => $validated['gambar'] ?? $produk->gambar
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        Storage::disk('public')->delete($produk->gambar);
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
