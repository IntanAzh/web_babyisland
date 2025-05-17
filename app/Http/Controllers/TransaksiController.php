<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transaksi = Transaksi::where('user_id', auth()->id())
            ->with('pemesanan')
            ->latest()
            ->paginate(10);
        return view('transaksi.index', compact('transaksi'));
    }

    public function create(Pemesanan $pemesanan)
    {
        $this->authorize('create', [Transaksi::class, $pemesanan]);
        return view('transaksi.create', compact('pemesanan'));
    }

    public function store(Request $request, Pemesanan $pemesanan)
    {
        $this->authorize('create', [Transaksi::class, $pemesanan]);

        $validated = $request->validate([
            'metode_pembayaran' => 'required|in:transfer_bank,e-wallet',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $bukti_pembayaran = $request->file('bukti_pembayaran')
            ->store('bukti_pembayaran', 'public');

        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'pemesanan_id' => $pemesanan->id,
            'total_pembayaran' => $pemesanan->total_harga,
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'bukti_pembayaran' => $bukti_pembayaran,
            'status' => 'pending'
        ]);

        return redirect()->route('transaksi.show', $transaksi)
            ->with('success', 'Bukti pembayaran berhasil diunggah dan sedang diverifikasi');
    }

    public function show(Transaksi $transaksi)
    {
        $this->authorize('view', $transaksi);
        return view('transaksi.show', compact('transaksi'));
    }

    public function confirm(Request $request, Transaksi $transaksi)
    {
        $this->authorize('confirm', $transaksi);

        $transaksi->update(['status' => 'success']);
        $transaksi->pemesanan->update(['status' => 'processing']);

        return redirect()->route('transaksi.show', $transaksi)
            ->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    public function reject(Request $request, Transaksi $transaksi)
    {
        $this->authorize('reject', $transaksi);

        $transaksi->update([
            'status' => 'failed',
            'keterangan' => $request->input('keterangan', 'Pembayaran ditolak')
        ]);

        // Kembalikan stok produk
        $transaksi->pemesanan->produk->increment('stok', $transaksi->pemesanan->jumlah);
        $transaksi->pemesanan->update(['status' => 'cancelled']);

        return redirect()->route('transaksi.show', $transaksi)
            ->with('success', 'Pembayaran berhasil ditolak');
    }
}
