<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $pengadaans = Pengadaan::with(['aset', 'user'])->get();
            return view('admin.usulan.index', compact('pengadaans'));
        } 
        
        else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Menampilkan halaman formulir
     */
    public function create()
    {
        $asets = Aset::all();
        return view('admin.usulan.create', compact('asets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'estimasi_biaya' => 'required|numeric',
        ]);
        Pengadaan::create([
            'user_id' => Auth::id(),
            'aset_id' => $request->aset_id,
            'estimasi_biaya' => $request->estimasi_biaya,
            'status_pengadaan' => 'pending', // Default
            'tanggal_pengadaan' => now(),
        ]); 

        return redirect()->route('pengadaan.index')->with('status_berhasil', 'Usulan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengadaan $pengadaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengadaan $pengadaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengadaan $pengadaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengadaan $pengadaan)
    {
        //
    }
}
