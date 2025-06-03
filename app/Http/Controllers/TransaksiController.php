<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display form for uploading payment proof (via POST)
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function showUploadForm(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'invoice' => 'required|string'
        ]);
        
        $order = Order::with(['product', 'transaction'])->findOrFail($validated['order_id']);
        
        // Check if order belongs to the current user if authenticated
        if (auth()->id() && $order->user_id != auth()->id()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
        }
        
        // Check if invoice matches the transaction
        if ($order->transaction->invoice != $validated['invoice']) {
            return redirect()->route('home')->with('error', 'Detail transaksi tidak valid.');
        }
        
        $title = 'Unggah Bukti Pembayaran';
        
        return view('unggah_bukti', compact('order', 'title'));
    }

    /**
     * Process payment proof upload
     */
    public function uploadPaymentProof(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $order = Order::with('transaction')->findOrFail($validated['order_id']);

        // Check if order belongs to the current user
        if (auth()->id() && $order->user_id != auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses ke pesanan ini');
        }

        // Upload and store the image
        $imagePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Update transaction with image path
        $order->transaction->update([
            'image' => $imagePath
        ]);

        // Store order data in session for the completion page
        session([
            'completed_order' => [
                'order_id' => $order->id,
                'invoice' => $order->transaction->invoice,
                'product_name' => $order->product->name,
                'total' => $order->total_price
            ]
        ]);

        return redirect()->route('selesai.unggah')->with('success', 'Bukti pembayaran berhasil diunggah. Pesanan Anda sedang diproses.');
    }
}
