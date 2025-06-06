<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $info = [
            'total_users' => 10,
            'total_products' => 20,
            'total_orders' => 30,
            'total_transactions' => 500000,
            'recent_orders' => collect([]), // kosongkan dulu
            'title' => 'Register'
        ];

        return view('admin.dashboard', compact('info'));
    }


    public function products()
    {
        $products = Product::with('category')->paginate(10);
        $title = 'Product';
        return view('admin.product.index', compact('products', 'title'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:finished,pending,confirmed,process,sent,complete,cancel,delivered'
        ]);

        $newStatus = $validated['status'];
        $oldStatus = $order->status;

        // Update the order status with the correct enum value
        $order->status = $newStatus;
        $order->save();

        // Update transaction status based on order status when applicable
        if ($order->transaction) {
            switch ($newStatus) {
                case 'confirmed':
                    $order->transaction->update(['status' => 'verified']);
                    break;

                case 'process':
                    // When processing, ensure transaction is verified
                    if ($order->transaction->status !== 'verified') {
                        $order->transaction->update(['status' => 'verified']);
                    }
                    break;

                case 'cancel':
                    $order->transaction->update(['status' => 'rejected']);

                    // Return the product stock
                    $order->product->increment('stock', $order->qty);
                    break;

                case 'complete':
                    $order->transaction->update(['status' => 'verified']);
                    break;
            }
        }

        $statusMessages = [
            'confirmed' => 'Pesanan telah dikonfirmasi dan pembayaran diverifikasi',
            'process' => 'Pesanan sedang diproses',
            'sent' => 'Pesanan telah dikirim',
            'complete' => 'Pesanan telah selesai',
            'cancel' => 'Pesanan telah dibatalkan'
        ];

        $message = $statusMessages[$newStatus] ?? 'Status pesanan berhasil diperbarui';

        return back()->with('success', $message);
    }
}
