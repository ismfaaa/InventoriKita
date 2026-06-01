<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Aset;
use App\Models\Peminjaman;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil data statistik dashboard
        $stats = DB::table('dashboard_stats')->where('id', 1)->first();

        // 2. Ambil data aset
        $asets = Aset::all(); 

        // 3. Ambil data peminjaman untuk dihitung (count) di dashboard
        try {
            $peminjamans = Peminjaman::all();
        } catch (\Exception $e) {
            $peminjamans = collect(); // Kirim koleksi kosong jika tabel belum ada
        }

        // 4. Kirim SEMUA variabel ke view dashboard
        return view('admin.dashboard', compact('stats', 'asets', 'peminjamans'));
    
    }

    public function updateStats(Request $request)
    {
        $request->validate([
            'kuantitas' => 'required|integer|min:0',
            'barang_tersedia' => 'required|integer|min:0',
            'sedang_dipinjam' => 'required|integer|min:0',
        ]);
        
        DB::table('dashboard_stats')->updateOrInsert(
            ['id' => 1],
            [
                'kuantitas' => $request->kuantitas,
                'barang_tersedia' => $request->barang_tersedia,
                'sedang_dipinjam' => $request->sedang_dipinjam,
                'updated_at' => now(),
            ]
        );

        return back()->with('success', 'Data berhasil diperbarui!');
    }
}