<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
   public function updateStats(Request $request)
{
    $request->validate([
        'barang_tersedia' => 'required|integer|min:0',
        'sedang_dipinjam' => 'required|integer|min:0',
    ]);

    // Proses simpan ke database...
    \DB::table('dashboard_stats')->updateOrInsert(
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

