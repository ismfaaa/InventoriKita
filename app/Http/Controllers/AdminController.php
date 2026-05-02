<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Aset;
// 1. Tambahkan import model Peminjaman jika kamu sudah punya modelnya
// use App\Models\Peminjaman; 

class AdminController extends Controller
{
    public function index()
    {
        // Ambil data stats
        $stats = DB::table('dashboard_stats')->where('id', 1)->first();

        // Ambil data aset
        $asets = Aset::all(); 

        // 2. Ambil data peminjaman agar count($peminjamans) tidak error
        // Jika kamu belum punya tabel peminjaman, kita buat array kosong dulu agar tidak error
        $peminjamans = DB::table('peminjamans')->get(); // Pastikan nama tabelnya benar

        // 3. Kirim SEMUA variabel ke view
        return view('admin.dashboard', compact('stats', 'asets', 'peminjamans'));
    }

    public function updateStats(Request $request)
    {
        $request->validate([
            'barang_tersedia' => 'required|integer|min:0',
            'sedang_dipinjam' => 'required|integer|min:0',
        ]);

        DB::table('dashboard_stats')->updateOrInsert(
            ['id' => 1],
            [
                'barang_tersedia' => $request->barang_tersedia,
                'sedang_dipinjam' => $request->sedang_dipinjam,
                'updated_at' => now(),
            ]
        );

        return back()->with('success', 'Data berhasil diperbarui!');
    }
}