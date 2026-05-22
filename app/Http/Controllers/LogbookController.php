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
        $search = $request->get('search');
        $filter = $request->get('filter');

        // 1. Ambil data Peminjaman
        $peminjaman = Peminjaman::with('user')->get()->map(function ($item) {
            return [
                'waktu' => $item->created_at,
                'pengguna' => $item->user->name,
                'aktivitas' => 'Melakukan peminjaman barang ' . $item->nama_barang,
                'tipe' => 'peminjaman',
            ];
        });

        // 2. Ambil data Pelaporan
        $pelaporan = Pelaporan::with('user')->get()->map(function ($item) {
            return [
                'waktu' => $item->created_at,
                'pengguna' => $item->user->name,
                'aktivitas' => 'Melaporkan kendala: ' . $item->jenis_laporan,
                'tipe' => 'pelaporan',
            ];
        });

        // 3. Ambil data Pengadaan
        $pengadaan = Pengadaan::with('user')->get()->map(function ($item) {
            return [
                'waktu' => $item->created_at,
                'pengguna' => $item->user->name,
                'aktivitas' => 'Mengajukan pengadaan ' . $item->nama_barang,
                'tipe' => 'pengadaan',
            ];
        });

        // 4. Gabungkan dan urutkan
        $semua = $peminjaman->concat($pelaporan)->concat($pengadaan)
                            ->sortByDesc('waktu')
                            ->values();

        // 5. Filter by tipe
        if ($filter) {
            $semua = $semua->filter(fn($item) => $item['tipe'] === $filter)->values();
        }

        // 6. Filter by search
        if ($search) {
            $semua = $semua->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['pengguna']), strtolower($search)) ||
                       str_contains(strtolower($item['aktivitas']), strtolower($search));
            })->values();
        }

        // 7. Pagination
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