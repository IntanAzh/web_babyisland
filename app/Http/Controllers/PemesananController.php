<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Produk $produk)
    {
        return view('pemesanan.create', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'qty' => 'required|integer|min:1|max:'.$produk->stok,
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'alamat' => 'required'
        ]);

        $days = Carbon::parse($validated['tanggal_mulai'])
            ->diffInDays($validated['tanggal_berakhir']);

        $pemesanan = Pemesanan::create([
            'user_id' => auth()->id(),
            'produk_id' => $produk->id,
            'qty' => $validated['qty'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_berakhir' => $validated['tanggal_berakhir'],
            'total_harga' => $produk->harga_perhari * $days * $validated['qty'],
            'alamat' => $validated['alamat'],
            'status' => 'pending'
        ]);

        // Update stok produk
        $produk->decrement('stok', $validated['qty']);

        return redirect()->route('transaksi.create', $pemesanan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        $this->authorize('view', $pemesanan);
        return view('pemesanan.show', compact('pemesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
