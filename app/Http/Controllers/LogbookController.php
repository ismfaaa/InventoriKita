<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pelaporan;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class LogbookController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data Peminjaman
        $peminjaman = Peminjaman::with('user')->get()->map(function ($item) {
            return [
                'waktu' => $item->created_at,
                'pengguna' => $item->user->name,
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

        // 4. Gabungkan dan urutkan
        $semua = $peminjaman->concat($pelaporan)->concat($pengadaan)
                            ->sortByDesc('waktu')
                            ->values();

        // 5. Pagination manual
        $perPage = 5;
        $currentPage = $request->get('page', 1);
        $items = $semua->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $logbook = new LengthAwarePaginator($items, $semua->count(), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('pages.logbook', compact('logbook'));
    }
}