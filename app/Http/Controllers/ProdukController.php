<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('kategori')->latest()->paginate(10);
        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'deskripsi' => 'required',
            'harga_perhari' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'required|image|max:2048'
        ]);

        $path = $request->file('gambar')->store('produk-images', 'public');

        Produk::create([
            ...$validated,
            'gambar' => $path,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);
        $kategori = Kategori::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $this->authorize('update', $produk);
        
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'deskripsi' => 'required',
            'harga_perhari' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($produk->gambar);
            $validated['gambar'] = $request->file('gambar')->store('produk-images', 'public');
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);
        
        Storage::disk('public')->delete($produk->gambar);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
