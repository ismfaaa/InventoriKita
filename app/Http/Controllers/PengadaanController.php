<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengadaanController extends Controller
{
  
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $pengadaans = Pengadaan::with(['aset', 'user'])->get();
            return view('admin.usulan.index', compact('pengadaans'));
        } 
        
        if ($user->role === 'stakeholder') {
            $pengadaans = Pengadaan::with(['aset', 'user'])->get();
            return view('stakeholder.pengadaan.index', compact('pengadaans'));
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

    public function updateStatus(Request $request, $id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        $newStatus = $request->input('status');

        if (!in_array($newStatus, ['pending', 'selesai', 'disetujui', 'ditolak'])) {
        return redirect()->back()->with('status_gagal', 'Status tidak valid');
        }

        if ($newStatus == 'disetujui' || $newStatus == 'ditolak') {
            $pengadaan->feedback_pengadaan = $newStatus;
            $pengadaan->status_pengadaan = 'selesai';
        } else {
            $pengadaan->status_pengadaan = $newStatus;
        }
        
        $pengadaan->save();
        $user = Auth::user();

        $totalPending = Pengadaan::where('status_pengadaan', 'pending')->count();

        if ($user->role === 'stakeholder') {
            return redirect()->route('feedback.pengadaan.index')->with('success', 'Feedback berhasil diberikan!');
        }
        return redirect()->back()->with('status_berhasil', 'Status pengadaan berhasil diperbarui');
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
