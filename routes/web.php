<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\auth\logoutController;
use App\Http\Controllers\Mitra\MitraController;
use App\Http\Controllers\auth\registerController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Controllers\Dashboard\DashboardAdminController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [registerController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register/auth', [registerController::class, 'registerAction'])->name('register.add')->middleware('guest');
Route::post('/logout', [logoutController::class, 'logout'])->name('logout');


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
    // ------------------------------------------------
    // Route Produk
    // ------------------------------------------------
    Route::get('/produk', [ProdukController::class, 'index'])->name('index.produk');
});
