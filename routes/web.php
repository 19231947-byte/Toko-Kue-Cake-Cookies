<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\AlternatifController;
use App\Http\Controllers\Admin\PerhitunganController;
use App\Http\Controllers\Admin\DetailPesananController;

// Frontend
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\ProdukController as FrontendProdukController;
use App\Http\Controllers\Frontend\KeranjangController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AkunController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('home'));

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/produk',      [FrontendProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [FrontendProdukController::class, 'show'])->name('produk.show');

Route::get('/kontak',  [\App\Http\Controllers\Frontend\KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [\App\Http\Controllers\Frontend\KontakController::class, 'kirim'])->name('kontak.kirim');

Route::get('/faq',               fn() => view('frontend.pusat-bantuan.faq'))->name('faq');
Route::get('/syarat-ketentuan',  fn() => view('frontend.pusat-bantuan.syarat-ketentuan'))->name('syarat-ketentuan');
Route::get('/kebijakan-privasi', fn() => view('frontend.pusat-bantuan.kebijakan-privasi'))->name('kebijakan-privasi');

/*
|--------------------------------------------------------------------------
| Frontend Auth Routes (guest customer only)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('frontend.login');
    Route::post('/login',    [AuthController::class, 'login'])->name('frontend.login.attempt');
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('frontend.register');
    Route::post('/register', [AuthController::class, 'register'])->name('frontend.register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:customer');

/*
|--------------------------------------------------------------------------
| Customer Routes (guard: customer)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:customer', 'role:customer'])->group(function () {
    Route::get('/keranjang',              [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/{id}',        [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::put('/keranjang/{key}',        [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{key}',     [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    Route::get('/checkout',         [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout',        [CheckoutController::class, 'proses'])->name('checkout.proses');
    Route::post('/checkout/simpan', [CheckoutController::class, 'simpan'])->name('checkout.simpan');
    Route::get('/checkout/sukses',  [CheckoutController::class, 'sukses'])->name('checkout.sukses');

    Route::get('/akun',            [AkunController::class, 'index'])->name('akun.index');
    Route::put('/akun',            [AkunController::class, 'update'])->name('akun.update');
    Route::put('/akun/password',   [AkunController::class, 'ubahPassword'])->name('akun.ubah-password');
    Route::get('/akun/pesanan',    [AkunController::class, 'pesanan'])->name('akun.pesanan');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (guard: admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login.attempt');
    });

    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout')->middleware('auth:admin');

    Route::middleware(['auth:admin', 'role:admin'])->group(function () {
        Route::get('/',          [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::resource('users',    UserController::class);
        Route::resource('kategori', KategoriController::class)->except(['show']);
        Route::resource('produk',   AdminProdukController::class)->except(['show']);
        Route::resource('kriteria',   KriteriaController::class)->except(['show']);
        Route::resource('alternatif', AlternatifController::class)->except(['show']);
        Route::get('/alternatif/{alternatif}/input-nilai',   [AlternatifController::class, 'inputNilai'])->name('alternatif.input-nilai');
        Route::post('/alternatif/{alternatif}/simpan-nilai', [AlternatifController::class, 'simpanNilai'])->name('alternatif.simpan-nilai');
        Route::get('/alternatif/{alternatif}/lihat-nilai',   [AlternatifController::class, 'lihatNilai'])->name('alternatif.lihat-nilai');

        Route::get('/perhitungan',        [PerhitunganController::class, 'index'])->name('perhitungan.index');
        Route::get('/perhitungan/hasil',  [PerhitunganController::class, 'hasil'])->name('perhitungan.hasil');

        Route::get('/pesanan',                  [PesananController::class, 'index'])->name('pesanan.index');
        Route::get('/pesanan/{pesanan}',         [PesananController::class, 'show'])->name('pesanan.show');
        Route::put('/pesanan/{pesanan}/status',  [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

        Route::get('/laporan',            [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export-pdf');

        Route::get('/pesan-kontak',                  [\App\Http\Controllers\Admin\PesanKontakController::class, 'index'])->name('pesan-kontak.index');
        Route::get('/pesan-kontak/{pesanKontak}',    [\App\Http\Controllers\Admin\PesanKontakController::class, 'show'])->name('pesan-kontak.show');
        Route::delete('/pesan-kontak/{pesanKontak}', [\App\Http\Controllers\Admin\PesanKontakController::class, 'destroy'])->name('pesan-kontak.destroy');
    });
});