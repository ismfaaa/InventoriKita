<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\Pelaporan;
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // PELAPORAN UNTUK ADMIN
        if ($user->role === 'admin') {    
            return view('admin.pelaporan.index');
        }
        
        // UNTUK PENGGUNA
        elseif ($user->role === 'pengguna') {
            $asets = Aset::all();
            return view('pengguna.pelaporan.index',compact('asets'));
        } 
        
        else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    
    {
        $asets = Aset::all();
        return view('pengguna.pelaporan.create',compact('asets')); //
    }

    
    public function store(Request $request)
    {
    $validated = $request->validate([
        'aset_id' => 'required',
        'tingkat_kerusakan' => 'required',
        'lokasi' => 'required',
        'deskripsi' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
    ]);

    // Proses upload gambar
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'data_file'; // Folder tujuan
        $file->move($tujuan_upload, $nama_file);
        $validated['foto'] = $nama_file;
    }

    $validated['user_id'] = auth()->id();
    $validated['status_pelaporan'] = 'pending';
    $validated['tanggal_pelaporan'] = now();

    Pelaporan::create($validated);

    return redirect()->route('pengguna.lapor.index')->with('status_berhasil', 'Laporan berhasil dikirim!');
    }

    /**

     */
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
