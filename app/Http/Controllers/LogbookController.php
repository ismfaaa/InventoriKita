<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use App\Models\Pelaporan;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    
    public function index()
{
    // 1. Ambil data Peminjaman
    $peminjaman = Peminjaman::with('user')->get()->map(function ($item) {
        return [
            'waktu' => $item->created_at,
            'pengguna' => $item->user->name, // Asumsi ada relasi ke tabel users
            'aktivitas' => 'Melakukan peminjaman barang ' . $item->nama_barang
        ];
    });

    // 2. Ambil data Pelaporan
    $pelaporan = Pelaporan::with('user')->get()->map(function ($item) {
        return [
            'waktu' => $item->created_at,
            'pengguna' => $item->user->name,
            'aktivitas' => 'Melaporkan kendala: ' . $item->jenis_laporan
        ];
    });

    // 3. Ambil data Pengadaan
    $pengadaan = Pengadaan::with('user')->get()->map(function ($item) {
        return [
            'waktu' => $item->created_at,
            'pengguna' => $item->user->name,
            'aktivitas' => 'Mengajukan pengadaan ' . $item->nama_barang
        ];
    });

    // 4. Gabungkan dan Urutkan
    $logbook = $peminjaman->concat($pelaporan)->concat($pengadaan)
                          ->sortByDesc('waktu')
                          ->values(); // Reset array index

    // 5. Lempar ke view
    return view('pages.logbook', compact('logbook'));
}
}