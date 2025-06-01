<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Transaksi;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $info = [
            'total_users' => User::where('role', 'user')->count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_transactions' => Order::where('status', 'complete')->sum('total_price'),
            'recent_orders' => Order::with('user', 'product')
                ->latest()
                ->limit(5)
                ->get(),
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

    public function users()
    {
        $users = User::where('role', 'user')->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function transactions()
    {
        $transactions = Transaksi::with('pemesanan')
            ->latest()
            ->paginate(10);

        return view('admin.transactions', compact('transactions'));
    }

    public function categories()
    {
        $categories = Category::paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function orders()
    {
        $orders = Pemesanan::with(['user', 'produk', 'transaksi'])
            ->latest()
            ->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Pemesanan $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        $order->update(['status' => $validated['status']]);
        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}
