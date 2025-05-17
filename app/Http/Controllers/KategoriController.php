<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->except(['index', 'show']);
    }

    public function index()
    {
        $categories = Kategori::withCount('produk')->paginate(10);
        return view('kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:kategori|max:255',
            'deskripsi' => 'nullable'
        ]);

        $kategori = Kategori::create([
            'nama' => $validated['nama'],
            'slug' => Str::slug($validated['nama']),
            'deskripsi' => $validated['deskripsi']
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Kategori $kategori)
    {
        $produk = $kategori->produk()->paginate(12);
        return view('kategori.show', compact('kategori', 'produk'));
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255|unique:kategori,nama,' . $kategori->id,
            'deskripsi' => 'nullable'
        ]);

        $kategori->update([
            'nama' => $validated['nama'],
            'slug' => Str::slug($validated['nama']),
            'deskripsi' => $validated['deskripsi']
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->produk()->exists()) {
            return back()->with('error', 'Tidak dapat menghapus kategori yang memiliki produk');
        }

        $kategori->delete();
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
