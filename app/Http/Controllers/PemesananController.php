<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pemesanan = Pemesanan::where('user_id', auth()->id())
            ->with(['produk', 'transaksi'])
            ->latest()
            ->paginate(10);
        return view('pemesanan.index', compact('pemesanan'));
    }

    public function create(Produk $produk)
    {
        return view('pemesanan.create', compact('produk'));
    }

    public function store(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $produk->stok,
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'alamat_pengiriman' => 'required|string'
        ]);

        $total_hari = \Carbon\Carbon::parse($validated['tanggal_mulai'])
            ->diffInDays($validated['tanggal_selesai']);
        $total_harga = $produk->harga * $validated['jumlah'] * $total_hari;

        $pemesanan = Pemesanan::create([
            'user_id' => auth()->id(),
            'produk_id' => $produk->id,
            'jumlah' => $validated['jumlah'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'total_hari' => $total_hari,
            'total_harga' => $total_harga,
            'alamat_pengiriman' => $validated['alamat_pengiriman'],
            'status' => 'pending'
        ]);

        // Kurangi stok produk
        $produk->decrement('stok', $validated['jumlah']);

        return redirect()->route('transaksi.create', $pemesanan)
            ->with('success', 'Pemesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function show(Pemesanan $pemesanan)
    {
        $this->authorize('view', $pemesanan);
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function cancel(Pemesanan $pemesanan)
    {
        $this->authorize('cancel', $pemesanan);

        if ($pemesanan->status !== 'pending') {
            return back()->with('error', 'Hanya pemesanan dengan status pending yang dapat dibatalkan');
        }

        $pemesanan->update(['status' => 'cancelled']);
        
        // Kembalikan stok produk
        $pemesanan->produk->increment('stok', $pemesanan->jumlah);

        return redirect()->route('pemesanan.index')
            ->with('success', 'Pemesanan berhasil dibatalkan');
    }

    public function track(Pemesanan $pemesanan)
    {
        $this->authorize('view', $pemesanan);
        return view('pemesanan.track', compact('pemesanan'));
    }
}
