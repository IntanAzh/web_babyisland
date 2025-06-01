<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with(['product', 'transaction'])
                ->latest()
                ->paginate(10);
        } else {
            $orders = Order::where('user_id', auth()->id())
                ->with(['product', 'transaction'])
                ->latest()
                ->paginate(10);
        }
        $title = 'Orders';

        return view('admin.order.index', compact('orders', 'title'));
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

    public function show(Order $order)
    {
        // $this->authorize('view', $order);
        $title = 'Detail Orders';
        return view('admin.order.show', compact('order','title'));
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
