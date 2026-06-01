<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\LogbookController;
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
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('pengguna.peminjaman.index');
    Route::post('/peminjaman-baru', [PeminjamanController::class, 'store'])->name('pengguna.peminjaman.store');

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
    //============================= DIGITAL LOGBOOK =============================
    Route::get('/InventoriKita/Digital-Logbook', [LogbookController::class, 'index'])->name('pengguna.logbook.index');

}); 

// :::::::::::::::::::::::::::::::::::::: PAGES :::::::::::::::::::::::::::::::

    // ============================ FAQ ==================================
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');

    // ============================ DOKUMENTASI ==================================
    Route::get('/dokumentasi', [App\Http\Controllers\DocumentationController::class, 'index'])->name('documentation.index');
    Route::get('/dokumentasi/{documentation}', [App\Http\Controllers\DocumentationController::class, 'show'])->name('documentation.show');
    Route::get('/dokumentasi/{documentation}/download', [App\Http\Controllers\DocumentationController::class, 'download'])->name('documentation.download');
    // INI BISA DIHILANGKAN DULU TAPI MALAH ERROR JADI OPSIONAL DIUBAHNYA LEWAT ROUTE INI

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
                'kuantitas' => $request->kuantitas,
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
    
    // ============================= USULAN PENGADAAN =============================
    Route::get('/pengadaan/usulan', [PengadaanController::class, 'index'])->name('pengadaan.index');
    Route::get('/pengadaan/usulan/baru', [PengadaanController::class, 'create'])->name('pengadaan.create');
    Route::post('/pengadaan/simpan', [PengadaanController::class, 'store'])->name('pengadaan.store');

    // ============================= MANAJEMEN FAQ =============================
    Route::get('/admin/faq', [FaqController::class, 'adminIndex'])->name('admin.faq.index');
    Route::get('/admin/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
    Route::post('/admin/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('/admin/faq/{faq}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::put('/admin/faq/{faq}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/admin/faq/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
});

// :::::::::::::::::::::::::::::: STAKEHOLDER :::::::::::::::::::::::::::::::::::::::
Route::middleware(['auth','stakeholder'])->group(function () {
    Route::get('/stakeholder', [StakeholderController::class, 'index'])->name('stakeholder.index');

// ============================= DOWNLOAD BUKU PEDOMAN ===============================
Route::get('/logbook', function () {
    $filePath = public_path('files/Buku_Pedoman_InventoriKita.pdf');
    if (file_exists($filePath)) {
        return response()->download($filePath, 'Buku_Pedoman_InventoriKita.pdf');
    } else {
        abort(404, 'File tidak ditemukan');
    }
})->name('logbook');    
});

// ============================= EKSPOR DATA =============================
Route::middleware(['auth'])->group(function () {
    Route::get('/export', [App\Http\Controllers\ExportController::class, 'index'])->name('export.index');
    
    // Pelaporan
    Route::get('/export/pelaporan/pdf', [App\Http\Controllers\ExportController::class, 'exportPelaporanPdf'])->name('export.pelaporan.pdf');
    Route::get('/export/pelaporan/excel', [App\Http\Controllers\ExportController::class, 'exportPelaporanExcel'])->name('export.pelaporan.excel');
    Route::get('/export/pelaporan/csv', [App\Http\Controllers\ExportController::class, 'exportPelaporanCsv'])->name('export.pelaporan.csv');
    
    // Pengadaan
    Route::get('/export/pengadaan/pdf', [App\Http\Controllers\ExportController::class, 'exportPengadaanPdf'])->name('export.pengadaan.pdf');
    Route::get('/export/pengadaan/excel', [App\Http\Controllers\ExportController::class, 'exportPengadaanExcel'])->name('export.pengadaan.excel');
    Route::get('/export/pengadaan/csv', [App\Http\Controllers\ExportController::class, 'exportPengadaanCsv'])->name('export.pengadaan.csv');
    
    // Aset
    Route::get('/export/aset/pdf', [App\Http\Controllers\ExportController::class, 'exportAsetPdf'])->name('export.aset.pdf');
    Route::get('/export/aset/excel', [App\Http\Controllers\ExportController::class, 'exportAsetExcel'])->name('export.aset.excel');
    Route::get('/export/aset/csv', [App\Http\Controllers\ExportController::class, 'exportAsetCsv'])->name('export.aset.csv');

    // Pedoman sederhana: download ManualBook_InventoriKita.pdf
    Route::get('/pedoman', [App\Http\Controllers\ExportController::class, 'pedoman'])->name('pedoman.index');
    Route::get('/pedoman/download', [App\Http\Controllers\ExportController::class, 'downloadBukuPedoman'])->name('pedoman.download');
//     Route::get('/pedoman/download', [App\Http\Controllers\ExportController::class, 'downloadTestingFile'])->name('pedoman.download');
    Route::get('/export', [ExportController::class, 'index'])->name('export.index');
    Route::get('/export/pelaporan/pdf', [ExportController::class, 'exportPelaporanPdf'])->name('export.pelaporan.pdf');
    Route::get('/export/pengadaan/pdf', [ExportController::class, 'exportPengadaanPdf'])->name('export.pengadaan.pdf');
    Route::get('/export/aset/pdf', [ExportController::class, 'exportAsetPdf'])->name('export.aset.pdf');

    // ============================= FEEDBACK PELAPORAN =============================
    Route::get('/stakeholder-feedback-pelaporan', [PelaporanController::class, 'index'])->name('feedback.pelaporan.index');
    Route::get('/stakeholder-feedback-pelaporan/{id}', [PelaporanController::class, 'show'])->name('stakeholder.pelaporan.show');
    Route::patch('/stakeholder-feedback-pelaporan/{id}/update-status', [PelaporanController::class, 'updateStatus'])->name('feedback.pelaporan.updateStatus');

    // ============================= FEEDBACK PENGADAAN =============================
    Route::get('/stakeholder-feedback-pengadaan', [PengadaanController::class, 'index'])->name('feedback.pengadaan.index');
    Route::patch('/stakeholder-feedback-pengadaan/{id}/update-status', [PengadaanController::class, 'updateStatus'])->name('feedback.pengadaan.updateStatus');

});

require __DIR__.'/auth.php';