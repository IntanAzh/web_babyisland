<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Pemesanan;
use App\Models\Transaksi;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_produk' => Produk::count(),
            'total_pemesanan' => Pemesanan::count(),
            'total_transaksi' => Transaksi::where('status', 'success')->count(),
            'recent_orders' => Pemesanan::with('user', 'produk')
                ->latest()
                ->limit(5)
                ->get()
        ];

        return view('admin.dashboard', compact('stats'));
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
}
