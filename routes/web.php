<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsetController;
use APp\Http\Controllers\KategoriController;
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

    // ============================= MANAJEMEN INVENTARIS =============================

    Route::get('/Manajemen-inventaris', [AsetController::class, 'index'])->name('admin.index');
    Route::get('/Manajemen-inventaris/create', [AsetController::class, 'create'])->name('inventaris.create');
    Route::post('/Manajemen-inventaris', [AsetController::class, 'store'])->name('inventaris.store');

    Route::get('/Manajemen-inventaris/edit', [AsetController::class, 'edit'])->name('inventaris.edit');
    Route::put('/Manajemen-inventaris', [AsetController::class, 'update'])->name('inventaris.update');
    Route::delete('/Manajemen-inventaris', [AsetController::class, 'destroy'])->name('inventaris.destroy');

    // ============================= MANAJEMEN KATEGORI =============================
    Route::get('/Manajemen-kategori', [KategoriController::class, 'index'])->name('admin.index');
    Route::get('/Manajemen-kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/Manajemen-kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/Manajemen-kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/Manajemen-kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/Manajemen-kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    

});


Route::middleware(['auth','stakeholder'])->group(function () {
    Route::get('/stakeholder', [StakeholderController::class, 'index'])->name('stakeholder.index');
});



require __DIR__.'/auth.php';
