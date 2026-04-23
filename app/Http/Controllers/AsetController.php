<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_aset' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|string|max:255',
        ]);

        // Simpan data aset ke database (contoh menggunakan model Aset)
        // Aset::create($validatedData);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('inventaris.index')->with('success', 'Aset berhasil ditambahkan!');
    }
}
