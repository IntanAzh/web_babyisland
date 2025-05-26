<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ReviewController;

Route::middleware('auth')->group(function () {
    // Dashboard & Profile
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('user.password.update');
    
    // Pemesanan
    Route::get('/pemesanan/create/{produk}', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan/{produk}', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/{pemesanan}', [PemesananController::class, 'show'])->name('pemesanan.show');
    
    // Transaksi
    Route::get('/transaksi/create/{pemesanan}', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/{pemesanan}', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
    
    // Review
    Route::get('/review/create/{pemesanan}', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review/{pemesanan}', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
});