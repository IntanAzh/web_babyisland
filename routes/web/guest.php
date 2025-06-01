<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

// Guest Routes (Akses tanpa login)
Route::get('/', function () {
    return view('home', [
        'title' => 'Home - Baby Island'
    ]);
})->name('home');

Route::get('/category', function () {
    return view('category', [
        'title' => 'Category - Baby Island'
    ]);
});

Route::get('/how-to-order', function () {
    return view('howtoder', [
        'title' => 'How to Order - Baby Island'
    ]);
});

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{produk:slug}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{kategori:slug}', [KategoriController::class, 'show'])->name('kategori.show');
