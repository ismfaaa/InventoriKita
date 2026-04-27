<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Aset;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index(Request $request){
        $search = $request->query('search');
        $category = $request->query('category');

        $kategoris = Kategori::all();

        $asets = Aset::query()
        ->when($search, function ($query, $search) {
            return $query->where('nama_aset', 'like', '%' . $search . '%')
                         ->orWhere('kode_aset', 'like', '%' . $search . '%');
        })
        ->when($category, function ($query, $category) {
            return $query->where('kategori_id', $category);
        })
        ->get();

        return view('pengguna.index', compact('asets', 'kategoris'));
    }
}
