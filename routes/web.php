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

//Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [AuthController::class, 'login']);
//Route::get('/register', [AuthController::class, 'showRegisterForm']);
//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');