<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\IdukaController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


// ==================== ROUTES UNIVERSAL ====================
Route::get('/', [HomeController::class, 'index'])->name('home');


// ==================== ROUTES SISWA ====================
// Auth Routes Siswa
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes Siswa
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Manage
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
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
        
        // Manajemen Siswa
        Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
        Route::get('/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
        Route::post('/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
        Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
        Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('admin.siswa.update');
        Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
        
        // Manajemen IDUKA
        Route::get('/iduka', [IdukaController::class, 'index'])->name('admin.iduka.index');
        Route::get('/iduka/create', [IdukaController::class, 'create'])->name('admin.iduka.create');
        Route::post('/iduka', [IdukaController::class, 'store'])->name('admin.iduka.store');
        Route::get('/iduka/{iduka}/edit', [IdukaController::class, 'edit'])->name('admin.iduka.edit');
        Route::put('/iduka/{iduka}', [IdukaController::class, 'update'])->name('admin.iduka.update');
        Route::delete('/iduka/{iduka}', [IdukaController::class, 'destroy'])->name('admin.iduka.destroy');
        
        // Manajemen Pendaftaran PKL
        Route::get('/pendaftaran', [AdminPendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
        Route::get('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('admin.pendaftaran.show');
        Route::put('/pendaftaran/{pendaftaran}/approve', [AdminPendaftaranController::class, 'approve'])->name('admin.pendaftaran.approve');
        Route::put('/pendaftaran/{pendaftaran}/reject', [AdminPendaftaranController::class, 'reject'])->name('admin.pendaftaran.reject');
        
        // Manajemen Petugas (hanya superadmin)
        Route::middleware(['superadmin'])->group(function () {
            Route::get('/petugas', [PetugasController::class, 'index'])->name('admin.petugas.index');
            Route::get('/petugas/create', [PetugasController::class, 'create'])->name('admin.petugas.create');
            Route::post('/petugas', [PetugasController::class, 'store'])->name('admin.petugas.store');
            Route::get('/petugas/{petugas}/edit', [PetugasController::class, 'edit'])->name('admin.petugas.edit');
            Route::put('/petugas/{petugas}', [PetugasController::class, 'update'])->name('admin.petugas.update');
            Route::delete('/petugas/{petugas}', [PetugasController::class, 'destroy'])->name('admin.petugas.destroy');
        });
    });
});