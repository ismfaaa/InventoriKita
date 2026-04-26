<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Aset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all();
        
        $search = $request->query('search');

        $asets = Aset::when($search, function ($query, $search) {
            return $query->where('nama_aset', 'like', '%' . $search . '%')
                        ->orWhere('kode_aset', 'like', '%' . $search . '%');
        })->get(); 

        return view('admin.inventaris.index', compact('asets', 'kategoris'));
    }

    public function create(){
        $kategoris = Kategori::all();
        return view('admin.inventaris.create', compact('kategoris'));
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
        Aset::create($validatedData);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('inventaris.index')->with('success', 'Aset berhasil ditambahkan!');
    }
}
