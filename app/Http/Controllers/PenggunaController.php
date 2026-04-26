<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Aset;
// use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index(){
        $kategoris = Kategori::all();
        $asets = Aset::all();
        return view('pengguna.index', compact('asets', 'kategoris'));
    }
}
