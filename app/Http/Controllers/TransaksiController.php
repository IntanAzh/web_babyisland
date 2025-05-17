<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function create(Pemesanan $pemesanan)
    {
        return view('transaksi.create', compact('pemesanan'));
    }

    public function store(Request $request, Pemesanan $pemesanan)
    {
        $validated = $request->validate([
            'nama_bank' => 'required|string|max:50',
            'nama_pemilik' => 'required|string|max:100',
            'nomor_rekening' => 'required|string|max:20',
            'gambar_bukti' => 'required|image|max:2048'
        ]);

        $path = $request->file('gambar_bukti')->store('bukti-transfer', 'public');

        Transaksi::create([
            'pemesanan_id' => $pemesanan->id,
            'nama_bank' => $validated['nama_bank'],
            'nama_pemilik' => $validated['nama_pemilik'],
            'nomor_rekening' => $validated['nomor_rekening'],
            'gambar_bukti' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('pemesanan.show', $pemesanan)
            ->with('success', 'Bukti pembayaran berhasil diupload');
    }

    public function confirm(Transaksi $transaksi)
    {
        // Hanya admin yang bisa konfirmasi
        $this->middleware('admin');
        
        $transaksi->update(['status' => 'success']);
        $transaksi->pemesanan->update(['status' => 'diproses']);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }
}
