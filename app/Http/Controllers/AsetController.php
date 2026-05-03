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
        $category = $request->query('category');

        $asets = Aset::query()
        ->when($search, function ($query, $search) {
            return $query->where('nama_aset', 'like', '%' . $search . '%')
                         ->orWhere('kode_aset', 'like', '%' . $search . '%');
        })
        ->when($category, function ($query, $category) {
            return $query->where('kategori_id', $category);
        })
        ->paginate(); 

        return view('admin.inventaris.index', compact('asets', 'kategoris'));
    }

    public function create(){
        $kategoris = Kategori::all();
        return view('admin.inventaris.create', compact('kategoris'));
    }

    public function store(Request $request){
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
        'kode_barang' => 'required|string|unique:asets,kode_aset', 
        'nama_barang' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id',
        'lokasi'      => 'required|string|max:255',
        'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Logika Upload Foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('asets', 'public');
        }
        
        Aset::create([
            'kode_aset'   => $request->kode_barang,
            'nama_aset'   => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'lokasi'      => $request->lokasi,
            'foto'        => $fotoPath, 
        ]);
            

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('inventaris.index')->with('success', 'Aset berhasil ditambahkan!');
    }

    public function edit($id){
        $aset = Aset::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.inventaris.edit', compact('aset', 'kategoris'));
    }

    // Fungsi untuk memproses data dari Modal Edit
    public function update(Request $request, $id)
    {
        // 1. Cari barang yang mau diedit berdasarkan ID
        $aset = Aset::findOrFail($id);

        // 2. Validasi data baru
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi'      => 'required|string|max:255',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 3. Cek apakah user upload foto baru?
        if ($request->hasFile('foto')) {
            
            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('asets', 'public');
            $aset->foto = $fotoPath; // Timpa path foto di database
        }

        // 4. Update data lainnya
        $aset->nama_aset   = $request->nama_barang;
        $aset->kategori_id = $request->kategori_id;
        $aset->lokasi      = $request->lokasi;
        $aset->save(); 

        return redirect()->route('inventaris.index')->with('success', 'Data aset berhasil diperbarui!');
    }

    // Fungsi untuk Hapus Barang
    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();

        return redirect()->route('inventaris.index')->with('success', 'Aset berhasil dihapus dari sistem!');
    }
}
