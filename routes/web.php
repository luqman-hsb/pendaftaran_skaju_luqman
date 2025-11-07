<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

// ==================== ROUTES SISWA ====================
// Auth Routes Siswa
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes Siswa
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // PKL Registration
    Route::get('/pkl/daftar', [PendaftaranController::class, 'showDaftarPKL'])->name('pkl.daftar');
    Route::get('/pkl/daftar/{iduka}', [PendaftaranController::class, 'showForm'])->name('pkl.form');
    Route::post('/pkl/daftar/{iduka}', [PendaftaranController::class, 'store'])->name('pkl.store');
    Route::get('/pkl/history', [PendaftaranController::class, 'history'])->name('pkl.history');
});

// ==================== ROUTES ADMIN/PETUGAS ====================
// Admin Auth Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware(['auth:petugas'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });
});