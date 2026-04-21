<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','pengguna'])->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth','stakeholder'])->group(function () {
    Route::get('/stakeholder', [StakeholderController::class, 'index'])->name('stakeholder.index');
});

// ======================== ADMIN ========================
// Tambah aset inventaris
Route::get('/inventaris/tambah', function () {
    return view('admin.create'); 
})->name('inventaris.create');

// Edit aset inventaris
Route::get('/inventaris/edit', function () {
    return view('admin.edit');
})->name('inventaris.edit');


require __DIR__.'/auth.php';
