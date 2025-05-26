<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Manajemen User
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    
    // Manajemen Kategori
    Route::resource('kategori', KategoriController::class)->except(['index', 'show']);
    
    // Manajemen Produk
    Route::resource('produk', ProdukController::class)->except(['index', 'show']);
    
    // Manajemen Pemesanan
    Route::get('/pemesanan', [AdminController::class, 'orders'])->name('admin.orders');
    Route::put('/pemesanan/{pemesanan}/status', [AdminController::class, 'updateOrderStatus'])
        ->name('admin.orders.update-status');
    
    // Manajemen Transaksi
    Route::get('/transaksi', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::put('/transaksi/{transaksi}/confirm', [TransaksiController::class, 'confirm'])
        ->name('admin.transaksi.confirm');
    Route::put('/transaksi/{transaksi}/reject', [TransaksiController::class, 'reject'])
        ->name('admin.transaksi.reject');
});