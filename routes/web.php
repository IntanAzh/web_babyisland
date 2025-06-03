<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('home', [
        'title' => 'Home'
    ]);
})->name('home');
Route::get('/how-to-order', function () {
    return view('how_to_order', [
        'title' => 'How to Order'
    ]);
})->name('how-to-order');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/produk/{id}', [App\Http\Controllers\ProductController::class, 'showDetail'])->name('product.detail');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('product', ProductController::class)->except(['show']);
    Route::resource('order', OrderController::class);
    // Add route for updating order status
    Route::put('/order/{order}/update-status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.update-status');

    Route::resource('kategori', KategoriController::class)->except(['index', 'show']);
    Route::get('/kategori', [KategoriController::class, 'adminIndex'])->name('admin.kategori.index');

});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('user.edit-profile');
    Route::put('/edit-profile', [UserController::class, 'updateProfile'])->name('user.update');
    
    // Add new route for cancelling orders
    Route::post('/cancel-order/{id}', [UserController::class, 'cancelOrder'])->name('user.cancel-order');

    // Order checkout flow
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/process-checkout', [OrderController::class, 'processCheckout'])->name('order.processCheckout');
    Route::post('/process-order', [OrderController::class, 'processOrder'])->name('order.process');

    Route::get('/pesanan-selesai', [OrderController::class, 'orderCompleted'])->name('pesanan.selesai');
    
    // Payment proof handling routes
    Route::post('/unggah-bukti', [TransaksiController::class, 'showUploadForm'])->name('unggah.bukti');
    Route::post('/upload-payment', [TransaksiController::class, 'uploadPaymentProof'])->name('transaksi.upload.payment');

    Route::get('/selesai', function () {
        return view('selesai', ['title' => 'Selesai']);
    })->name('selesai.unggah');

    Route::get('/ulasan', function () {
        return view('ulasan', ['title' => 'Ulasan']);
    })->name('ulasan');
    
    // Add new route for handling review submissions
    Route::post('/ulasan', [ReviewController::class, 'submitReview'])->name('review.submit');

});