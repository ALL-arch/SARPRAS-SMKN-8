<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\JadwalServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;

// Root URL
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// ===== Dashboard =====
Route::middleware('auth')->group(function () {
    // Dashboard utama
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

// ===== CRUD Inventaris =====
Route::middleware('auth')->group(function () {
    Route::resource('inventaris', InventarisController::class)
        ->parameters(['inventaris' => 'inventaris']);

    Route::get('inventaris/get-by-kode/{kode}', [InventarisController::class, 'getByKode'])
        ->name('inventaris.getByKode');
});

// ===== CRUD Peminjaman =====
Route::middleware('auth')->group(function () {
    Route::resource('peminjaman', PeminjamanController::class);
});

// ===== CRUD Pengembalian =====
Route::middleware('auth')->group(function () {
    Route::resource('pengembalian', PengembalianController::class);
});

// ===== CRUD Jadwal Service =====
Route::middleware('auth')->group(function () {
    Route::resource('jadwal_service', JadwalServiceController::class)
        ->parameters(['jadwal_service' => 'jadwal_service']);
});


// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Auth Routes (login/register)
require __DIR__.'/auth.php';
