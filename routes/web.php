<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
})->name('home');

Route::get('/howtoder', function () {
    return view('howtoder', ['title' => 'How To Order']);
});

Route::get('/category', function () {
    return view('category', ['title' => 'Category']);
});

Route::get('/login', function () {
    return view('login', ['title' => 'Login']);
})->name('login');

Route::get('/register', function () {
    return view('register', ['title' => 'Register']);
})->name('register');

Route::get('/category_perjalanan', function () {
    return view('category_perjalanan', ['title' => 'Perjalanan']);
})->name('category_perjalanan');

Route::get('/category_mainan', function () {
    return view('category_mainan', ['title' => 'Mainan']);
})->name('category_mainan');

Route::get('/category_tidur', function () {
    return view('category_tidur', ['title' => 'Tidur']);
})->name('category_tidur');

Route::get('/produk', function () {
    return view('produk', ['title' => 'Produk']);
})->name('produk');

Route::get('/checkout', function () {
    return view('checkout', ['title' => 'Checkout']);
})->name('checkout');

Route::get('/detail_co', function () {
    return view('detail_co', ['title' => 'Detail_co']);
})->name('detail_co');

Route::get('/pesanan-selesai', function () {
    return view('pesanan_selesai', ['title' => 'Pesanan Selesai']);
})->name('pesanan.selesai');


Route::get('/unggah-bukti', function () {
    return view('unggah_bukti', ['title' => 'Unggah Bukti']);
})->name('unggah.bukti');

Route::post('/unggah-bukti', function (Request $request) {
    $request->validate([
        'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $file = $request->file('bukti_pembayaran');
    $file->storeAs('public/bukti', $file->getClientOriginalName());

    return back()->with('success', 'Bukti pembayaran berhasil diunggah!');
});

Route::get('/selesai', function () {
    return view('selesai', ['title' => 'Selesai']);
})->name('selesai.unggah');

Route::get('/ulasan', function () {
    return view('ulasan', ['title' => 'Ulasan']);
})->name('ulasan');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard', ['title' => 'Dashboard']);
})->name('admin.dashboard');

Route::get('/admin/allproduk', function () {
    return view('admin.allproduk', ['title' => 'All Produk']);
})->name('admin.allproduk');

Route::get('/admin/orderlist', function () {
    return view('admin.orderlist', ['title' => 'Order List']);
})->name('admin.orderlist');

Route::get('/admin/detailorder', function () {
    return view('admin.detailorder', ['title' => ' Detail Order']);
})->name('admin.detailorder');

Route::get('/admin/produkedit', function () {
    return view('admin.produkedit', ['title' => 'Produk Edit']);
})->name('admin.produkedit');

Route::get('/admin/tambahproduk', function () {
    return view('admin.tambahproduk', ['title' => 'Tambah Produk']);
})->name('admin.tambahproduk');

Route::get('/admin/notification', function () {
    return view('admin.notification', ['title' => ' Notification']);
})->name('admin.notification');

Route::get('/admin/changepass', function () {
    return view('admin.changepass', ['title' => ' Change Password']);
})->name('admin.changepass');

Route::get('/admin/payment-proof', function () {
    return view('admin.payment-proof', ['title' => 'Bukti Pembayaran Customer']);
})->name('admin.payment-proof');



//Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [AuthController::class, 'login']);
//Route::get('/register', [AuthController::class, 'showRegisterForm']);
//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');