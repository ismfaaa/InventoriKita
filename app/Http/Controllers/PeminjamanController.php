<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;


class PeminjamanController extends Controller
{
    public function index()
{
    // Logika menampilkan daftar peminjaman
    return view('pengguna.peminjaman.index');
}

public function create()
{
    // Mengambil data aset untuk dropdown di form
    $asets = \App\Models\Aset::all(); 
    return view('pengguna.peminjaman.create', compact('asets'));
}

public function store(Request $request)
{
{
    $validated = $request->validate([
        'aset_id' => 'required',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'user_id' => 'required',
        'status_peminjaman' => 'required',
        'status_ketersediaan' => 'required',
    ]);

    $validated['status_peminjaman'] = 'diproses'; 
    $validated['status_ketersediaan'] = 'tersedia';

    Peminjaman::create($validated);

    return redirect()->route('peminjaman.index')->with('success', 'Data berhasil disimpan!');
}
}
}