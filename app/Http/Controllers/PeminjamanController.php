<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Peminjaman extends Controller
{
    public function index()
{
    // Logika menampilkan daftar peminjaman
    return view('peminjaman.index');
}

public function create()
{
    // Mengambil data aset untuk dropdown di form
    $asets = \App\Models\Aset::all(); 
    return view('peminjaman.create', compact('asets'));
}

public function store(Request $request)
{
    // Logika validasi dan simpan data ke database
    // Setelah simpan, redirect kembali ke index
}
}
