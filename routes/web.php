<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PelaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ::::::::::::::::::::::::::::::::: PENGGUNA :::::::::::::::::::::::::::::::::
Route::middleware(['auth','pengguna'])->group(function () {
    Route::get('/InventoriKita', [PenggunaController::class, 'index'])->name('pengguna.index');
    
    // ============================= PEMINJAMAN =============================
    Route::get('/Manajemen-peminjaman', [PeminjamanController::class, 'index'])->name('pengguna.peminjaman.index');
    Route::post('/Manajemen-peminjaman', [PeminjamanController::class, 'store'])->name('pengguna.peminjaman.store');

    Route::get('/InventoriKita/peminjaman', function () {
        return view('pengguna.peminjaman.index');
    })->name('pengguna.peminjaman.index_alt'); // Nama dibedakan sedikit agar tidak bentrok dengan di atas

    Route::get('/InventoriKita/peminjaman/tambah', function () {
        $asets = \App\Models\Aset::all(); 
        return view('pengguna.peminjaman.create', compact('asets'));
    })->name('pengguna.peminjaman.create');

    Route::get('/InventoriKita/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('pengguna.peminjaman.show');
    Route::post('/InventoriKita/peminjaman/simpan', function () {
        return redirect()->route('pengguna.peminjaman.index')->with('success', 'Berhasil dikirim');
    })->name('pengguna.peminjaman.store_alt');

   // ============================= PELAPORAN =============================
    Route::get('/InventoriKita/lapor-kerusakan', [PelaporanController::class, 'index'])->name('pengguna.lapor.index');
    Route::get('/InventoriKita/lapor-kerusakan/baru', [PelaporanController::class, 'create'])->name('pengguna.lapor.create');
    Route::post('/InventoriKita/lapor-kerusakan/simpan', [PelaporanController::class, 'store'])->name('pengguna.lapor.store');

}); 

// :::::::::::::::::::::::::::::::::::::: PAGES :::::::::::::::::::::::::::::::

    // ============================ FAQ ================================= 
    Route::get('/faq', function () {
        return view('pages.faq');
    })->name('faq');


// ::::::::::::::::::::::::::::::::::: ADMIN :::::::::::::::::::::::::::::::::::

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // ============================= MANAJEMEN INVENTARIS =============================
    Route::get('/Manajemen-inventaris', [AsetController::class, 'index'])->name('inventaris.index');
    Route::get('/Manajemen-inventaris/create', [AsetController::class, 'create'])->name('inventaris.create');
    Route::post('/Manajemen-inventaris', [AsetController::class, 'store'])->name('inventaris.store');

    Route::get('/Manajemen-inventaris/{id}/edit', [AsetController::class, 'edit'])->name('inventaris.edit');
    Route::put('/Manajemen-inventaris/{id}', [AsetController::class, 'update'])->name('inventaris.update');
    Route::delete('/Manajemen-inventaris/{id}', [AsetController::class, 'destroy'])->name('inventaris.destroy');

    // ============================= MANAJEMEN KATEGORI =============================
    Route::get('/Manajemen-kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/Manajemen-kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/Manajemen-kategori', [KategoriController::class, 'store'])->name('kategori.store');

    Route::get('/Manajemen-kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/Manajemen-kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/Manajemen-kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    
    // ============================= MANAJEMEN DASHBOARD =============================
    Route::post('/admin/update-stats', function (\Illuminate\Http\Request $request) {
        \Illuminate\Support\Facades\DB::table('dashboard_stats')->updateOrInsert(
            ['id' => 1],
            [
                'barang_tersedia' => $request->barang_tersedia,
                'sedang_dipinjam' => $request->sedang_dipinjam,
                'updated_at' => now(),
            ]
        );
        return back()->with('success', 'Dashboard berhasil diupdate!');
    })->name('admin.update_stats');

    // ============================= MANAJEMEN PEMINJAMAN =============================
    Route::get('/Manajemen-peminjaman-admin', [PeminjamanController::class, 'index'])->name('manajemen.peminjaman.index');
    Route::patch('/Manajemen-peminjaman/{id}/update-status', [PeminjamanController::class, 'updateStatus'])->name('admin.peminjaman.updateStatus');
    Route::get('/Manajemen-peminjaman/{id}', [PeminjamanController::class, 'show'])->name('admin.peminjaman.show');

    // ============================= MANAJEMEN PELAPORAN =============================
    Route::get('/Manajemen-pelaporan', [PelaporanController::class, 'index'])->name('manajemen.pelaporan.index');
    Route::patch('/Manajemen-pelaporan/{id}/update-status', [PelaporanController::class, 'updateStatus'])->name('admin.pelaporan.updateStatus');
    Route::get('/Manajemen-pelaporan/{id}', [PelaporanController::class, 'show'])->name('manajemen.pelaporan.show');
    
});

// :::::::::::::::::::::::::::::: STAKEHOLDER :::::::::::::::::::::::::::::::::::::::
Route::middleware(['auth','stakeholder'])->group(function () {
    Route::get('/stakeholder', [StakeholderController::class, 'index'])->name('stakeholder.index');
});

require __DIR__.'/auth.php';