<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','pengguna'])->group(function () {
    Route::get('/InventoriKita', [PenggunaController::class, 'index'])->name('pengguna.index');
    // Route::get('/InventoriKita/Dashboard', [AsetController::class, 'penggunaindex'])->name('pengguna.dashboard');
    // ============================= PEMINJAMAN =============================
    Route::get('/InventoriKita/Peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::resource('peminjaman', PeminjamanController::class,);
    
    // ============================= PEMINJAMAN =============================
    Route::get('/InventoriKita/peminjaman', function () {
        return view('pengguna.peminjaman.index');
    })->name('pengguna.peminjaman.index');

    Route::get('/InventoriKita/peminjaman/tambah', function () {
        $asets = \App\Models\Aset::all(); 
        return view('pengguna.peminjaman.create', compact('asets'));
    })->name('pengguna.peminjaman.create');

    Route::get('/InventoriKita/peminjaman/{id}', function ($id) {
        return view('pengguna.peminjaman.show', ['id' => $id]);
    })->name('pengguna.peminjaman.show');

    Route::post('/InventoriKita/peminjaman/simpan', function () {
        return redirect()->route('pengguna.peminjaman.index')->with('success', 'Berhasil dikirim');
    })->name('pengguna.peminjaman.store');

    // ============================= PELAPORAN  =============================
    Route::get('/InventoriKita/lapor-kerusakan', function () {
        $asets = \App\Models\Aset::all(); 
        return view('pengguna.pelaporan.create'); 
    })->name('pengguna.lapor.create');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // ============================= MANAJEMEN PEMINJAMAN (PERBAIKAN DISINI) =============================
    Route::get('/admin/peminjaman', function () {
        // Kita ambil data peminjaman agar variabel $peminjamans tersedia di Blade
        // Menggunakan try-catch agar jika tabel belum ada, tetap tidak error
        try {
            $peminjamans = \App\Models\Peminjaman::with(['user', 'aset'])->get();
        } catch (\Exception $e) {
            $peminjamans = collect(); // Kirim koleksi kosong jika tabel belum ada
        }
        
        return view('admin.peminjaman.index', compact('peminjamans'));
    })->name('admin.peminjaman.index');

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
    Route::get('/Manajemen-peminjaman', [PeminjamanController::class, 'index'])->name('manajemen.peminjaman');  
});

Route::middleware(['auth','stakeholder'])->group(function () {
    Route::get('/stakeholder', [StakeholderController::class, 'index'])->name('stakeholder.index');
});

require __DIR__.'/auth.php';
