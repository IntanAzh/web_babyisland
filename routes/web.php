<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;
use App\Models\Order;
use App\Models\Product;

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

Route::get('/category', function () {
    return view('category', [
        'title' => 'Category'
    ]);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('product', ProductController::class)->except(['show']);

    Route::resource('order', OrderController::class);


    // Manajemen User
    // Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    // // Manajemen Kategori
    // Route::resource('kategori', KategoriController::class)->except(['index', 'show']);

    // // Manajemen Produk

    // // Manajemen Pemesanan
    // Route::get('/pemesanan', [AdminController::class, 'orders'])->name('admin.orders');
    // Route::put('/pemesanan/{pemesanan}/status', [AdminController::class, 'updateOrderStatus'])
    //     ->name('admin.orders.update-status');

    // // Manajemen Transaksi
    // Route::get('/transaksi', [AdminController::class, 'transactions'])->name('admin.transactions');
    // Route::put('/transaksi/{transaksi}/confirm', [TransaksiController::class, 'confirm'])
    //     ->name('admin.transaksi.confirm');
    // Route::put('/transaksi/{transaksi}/reject', [TransaksiController::class, 'reject'])
    //     ->name('admin.transaksi.reject');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/test', function () {
        return view('home', [
            'title' => 'Home'
        ]);
    })->name('test');
    // Dashboard & Profile

    // Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    // Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    // Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    // Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('user.password.update');

    // // Pemesanan
    // Route::get('/pemesanan/create/{produk}', [PemesananController::class, 'create'])->name('pemesanan.create');
    // Route::post('/pemesanan/{produk}', [PemesananController::class, 'store'])->name('pemesanan.store');
    // Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    // Route::get('/pemesanan/{pemesanan}', [PemesananController::class, 'show'])->name('pemesanan.show');

    // // Transaksi
    // Route::get('/transaksi/create/{pemesanan}', [TransaksiController::class, 'create'])->name('transaksi.create');
    // Route::post('/transaksi/{pemesanan}', [TransaksiController::class, 'store'])->name('transaksi.store');
    // Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    // Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');

    // // Review
    // Route::get('/review/create/{pemesanan}', [ReviewController::class, 'create'])->name('review.create');
    // Route::post('/review/{pemesanan}', [ReviewController::class, 'store'])->name('review.store');
    // Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
});


// Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
// Route::get('/produk/{produk:slug}', [ProdukController::class, 'show'])->name('produk.show');
// Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
// Route::get('/kategori/{kategori:slug}', [KategoriController::class, 'show'])->name('kategori.show');





















// Route::get('/category_perjalanan', function () {
//     return view('category_perjalanan', ['title' => 'Perjalanan']);
// })->name('category_perjalanan');

// Route::get('/category_mainan', function () {
//     return view('category_mainan', ['title' => 'Mainan']);
// })->name('category_mainan');

// Route::get('/category_tidur', function () {
//     return view('category_tidur', ['title' => 'Tidur']);
// })->name('category_tidur');

// Route::get('/produk', function () {
//     return view('produk', ['title' => 'Produk']);
// })->name('produk');

// Route::get('/checkout', function () {
//     return view('checkout', ['title' => 'Checkout']);
// })->name('checkout');

// Route::get('/detail_co', function () {
//     return view('detail_co', ['title' => 'Detail_co']);
// })->name('detail_co');

// Route::get('/pesanan-selesai', function () {
//     return view('pesanan_selesai', ['title' => 'Pesanan Selesai']);
// })->name('pesanan.selesai');


// Route::get('/unggah-bukti', function () {
//     return view('unggah_bukti', ['title' => 'Unggah Bukti']);
// })->name('unggah.bukti');

// Route::post('/unggah-bukti', function (Request $request) {
//     $request->validate([
//         'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
//     ]);

//     $file = $request->file('bukti_pembayaran');
//     $file->storeAs('public/bukti', $file->getClientOriginalName());

//     return back()->with('success', 'Bukti pembayaran berhasil diunggah!');
// });

// Route::get('/selesai', function () {
//     return view('selesai', ['title' => 'Selesai']);
// })->name('selesai.unggah');

// Route::get('/ulasan', function () {
//     return view('ulasan', ['title' => 'Ulasan']);
// })->name('ulasan');

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard', ['title' => 'Dashboard']);
// })->name('admin.dashboard');

// Route::get('/admin/allproduk', function () {
//     return view('admin.allproduk', ['title' => 'All Produk']);
// })->name('admin.allproduk');

// Route::get('/admin/orderlist', function () {
//     return view('admin.orderlist', ['title' => 'Order List']);
// })->name('admin.orderlist');

// Route::get('/admin/detailorder', function () {
//     return view('admin.detailorder', ['title' => ' Detail Order']);
// })->name('admin.detailorder');

// Route::get('/admin/produkedit', function () {
//     return view('admin.produkedit', ['title' => 'Produk Edit']);
// })->name('admin.produkedit');

// Route::get('/admin/tambahproduk', function () {
//     return view('admin.tambahproduk', ['title' => 'Tambah Produk']);
// })->name('admin.tambahproduk');

// Route::get('/admin/notification', function () {
//     return view('admin.notification', ['title' => ' Notification']);
// })->name('admin.notification');

// Route::get('/admin/changepass', function () {
//     return view('admin.changepass', ['title' => ' Change Password']);
// })->name('admin.changepass');

// Route::get('/admin/payment-proof', function () {
//     return view('admin.payment-proof', ['title' => 'Bukti Pembayaran Customer']);
// })->name('admin.payment-proof');




//Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [AuthController::class, 'login']);
//Route::get('/register', [AuthController::class, 'showRegisterForm']);
//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
