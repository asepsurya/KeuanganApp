<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ikm\IkmController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\auth\logoutController;
use App\Http\Controllers\Mitra\MitraController;
use App\Http\Controllers\auth\registerController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Controllers\Region\RegionController;
use App\Http\Controllers\Keuangan\HistoryController;
use App\Http\Controllers\Keuangan\KeuanganController;
use App\Http\Controllers\Transaksi\TransaksiController;
use App\Http\Controllers\Dashboard\DashboardAdminController;


Route::get('/', [AuthController::class, 'index'])->middleware('guest');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [registerController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register/auth', [registerController::class, 'registerAction'])->name('register.add')->middleware('guest');
Route::post('/logout', [logoutController::class, 'logout'])->name('logout');

// ------------------------------------------------
// route Regency Administrasi
// ------------------------------------------------
Route::post('/getkabupaten',[RegionController::class,'getkabupaten'])->name('getkabupaten');
Route::post('/getkecamatan',[RegionController::class,'getkecamatan'])->name('getkecamatan');
Route::post('/getdesa',[RegionController::class,'getdesa'])->name('getdesa');

Route::middleware(['auth'])->group(function () {
    // ------------------------------------------------
    // Dashboard Admin
    // ------------------------------------------------
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/keuangan', [DashboardAdminController::class, 'dashboardKeuangan'])->name('dashboard.keuangan');
    Route::get('/dashboard/peta pemasaran', [DashboardAdminController::class, 'peta_pemasaran'])->name('dashboard.peta');

    // ------------------------------------------------
    // Route Mitra
    // ------------------------------------------------
    Route::get('/mitra', [MitraController::class, 'index'])->name('index.mitra');
    Route::get('/mitra/detail/{id}', [MitraController::class, 'mitraDetail'])->name('detail.mitra');
    Route::post('/mitra/detail/update', [MitraController::class, 'mitraupdate'])->name('update.mitra');
    Route::delete('/mitra/produk/delete/{id}', [MitraController::class, 'mitaProdukDelete'])->name('produk.mitra.delete');
    Route::get('/mitra/create', [MitraController::class, 'create'])->name('mitra.add');
    Route::get('/mitra/delete/{id}', [MitraController::class, 'mitraDelete'])->name('mitra.delete');
    Route::post('/mitra/create/action', [MitraController::class, 'createAction'])->name('mitra.create');
    // ------------------------------------------------
    // Route Produk
    // ------------------------------------------------
    Route::get('/produk', [ProdukController::class, 'index'])->name('index.produk');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('index.create.produk');
    Route::get('/produk/update/{id}', [ProdukController::class, 'update'])->name('index.update.produk');
    Route::post('/produk/update/', [ProdukController::class, 'updateaction'])->name('action.update');
    Route::get('/produk/delete/{id}', [ProdukController::class, 'deleteaction'])->name('action.delete');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/category', [ProdukController::class, 'category'])->name('produk.category');
    Route::post('/produk/category', [ProdukController::class, 'createCategory'])->name('category.add');
    Route::post('/produk/category/update', [ProdukController::class, 'updateCategory'])->name('category.update');
    Route::get('/produk/category/delete/{id}', [ProdukController::class, 'deleteCategory'])->name('category.delete');
    // ------------------------------------------------
    // Route IKM
    // ------------------------------------------------
    Route::get('/people', [IkmController::class, 'index'])->name('index.ikm');
    Route::get('/people/create', [IkmController::class, 'create'])->name('ikm.create');
    Route::post('/people/create', [IkmController::class, 'store'])->name('ikm.store');
    Route::get('/people/delete/{id}', [IkmController::class, 'delete'])->name('ikm.delete');
    Route::get('/people/update/{id}', [IkmController::class, 'update'])->name('ikm.update');
    Route::post('/people/update/action', [IkmController::class, 'updateIkm'])->name('ikm.update.action');
    Route::post('/people/update/foto', [IkmController::class, 'updateFoto'])->name('ikm.update.foto');
    // ------------------------------------------------
    // Route Keuangan
    // ------------------------------------------------
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('index.keuangan');
    Route::get('/keuangan/kalender', [KeuanganController::class, 'kelenderIndex'])->name('keuangan.kalender');
    Route::post('/keuangan/add', [KeuanganController::class, 'keuanganAdd'])->name('keuangan.add');
    Route::post('/keuangan/update', [KeuanganController::class, 'keuanganUpdate'])->name('keuangan.update');
    Route::get('/keuangan/delete/{id}', [KeuanganController::class, 'keuanganDelete'])->name('keuangan.delete');
    // ------------------------------------------------
    // Route Akun dan Rekening
    // ------------------------------------------------
    Route::get('/akun', [KeuanganController::class, 'IndexAkun'])->name('index.akun');
    Route::post('/akun/create', [KeuanganController::class, 'akunCreate'])->name('akun.create');
    Route::post('/akun/update', [KeuanganController::class, 'akunUpdate'])->name('akun.update');
    Route::get('/akun/delete/{id}', [KeuanganController::class, 'akunDelete'])->name('akun.delete');
    Route::get('/rekening', [KeuanganController::class, 'rekeningIndex'])->name('akun.rekening');
    Route::post('/rekening', [KeuanganController::class, 'rekeningAdd'])->name('rekening.add');
    Route::post('/rekening/update', [KeuanganController::class, 'rekeningUpdate'])->name('rekening.update');
    Route::delete('/rekening/hapus/{id}', [KeuanganController::class, 'rekeningDelete'])->name('rekening.delete');
    Route::get('/rekening/default/{id}', [KeuanganController::class, 'rekeningDefault'])->name('default.rekening');
    Route::get('/rekening/{id_rekening}', [HistoryController::class, 'rekeningHistory'])->name('rekening.history');

    // ------------------------------------------------
    // Route  Transaksi Induk Mitra
    // ------------------------------------------------
    Route::get('/transaksi', [TransaksiController::class, 'transaksiIndex'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'DetailTransaki'])->name('transaksi.detail');
    Route::post('/transaksi/create', [TransaksiController::class, 'transaksiCreate'])->name('transaksi.create');
});
