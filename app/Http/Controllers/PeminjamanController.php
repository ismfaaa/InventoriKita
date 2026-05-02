<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// use App\Models\Kategori;
// use App\Models\Aset;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use App\Models\Peminjaman;


class PeminjamanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // UNTUK ADMIN
        if ($user->role === 'admin') {
            
            return view('admin.peminjaman.index');
        } 
        
        // UNTUK PENGGUNA
        elseif ($user->role === 'pengguna') {
            return view('pengguna.peminjaman.index');
        } 
        
        else {
            abort(403, 'Unauthorized');
        }
    
    }
}

public function create()
{
    // Mengambil data aset untuk dropdown di form
    $asets = \App\Models\Aset::all(); 
    return view('pengguna.peminjaman.create', compact('asets'));
}

public function store(Request $request)

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
