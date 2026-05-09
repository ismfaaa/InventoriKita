<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $pelaporans = Pelaporan::with(['aset', 'user'])->get();
            return view('admin.pelaporan.index', compact('pelaporans'));
        } 
        
        elseif ($user->role === 'pengguna') {
            $asets = Aset::all();
            $pelaporans = Pelaporan::where('user_id', $user->id)->with('aset')->get();
            return view('pengguna.pelaporan.index', compact('pelaporans', 'asets'));
        } 
        
        else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Menampilkan form input laporan baru.
     */
    public function create()
    
    {
        $asets = Aset::all();
        return view('pengguna.pelaporan.create', compact('asets'));
    }

    /**
     * Menyimpan data pelaporan ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'aset_id'           => 'required|exists:asets,id',
            'tingkat_kerusakan' => 'required|in:ringan,sedang,berat',
            'lokasi'            => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'foto'              => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

    $laporanAda = Pelaporan::where('aset_id', $request->aset_id)
        ->whereIn('status_pelaporan', ['diproses']) 
        ->first();

    if ($laporanAda) {
        return redirect()->back()
            ->withInput() 
            ->with('error_kritis', 'Aset ini sudah dilaporkan sebelumnya dan sedang dalam penanganan.');
    }

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pelaporan', 'public');
            $data['foto'] = $path;
        }

        $data['user_id'] = Auth::id();
        $data['status_pelaporan'] = 'diproses';
        $data['tanggal_pelaporan'] = now();

        Pelaporan::create($data);

        return redirect()->route('pengguna.lapor.index')->with('status_berhasil', 'Laporan kerusakan berhasil dikirim!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pelaporan' => 'required|in:diproses,verifikasi,feedback,selesai',
            'feedback' => 'nullable|in:diperbaiki,diganti,dihilangkan',
        ]);

        $laporan = Pelaporan::findOrFail($id);
        $laporan->status_pelaporan = $request->status_pelaporan;

        if ($request->has('feedback')) {
            $laporan->feedback = $request->feedback;
        }

        $laporan->save();

        return redirect()->route('manajemen.pelaporan.index')->with('success', 'Status laporan berhasil diperbarui!');
    }

    public function show(Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelaporan $pelaporan)
    {
        //
    }
}
