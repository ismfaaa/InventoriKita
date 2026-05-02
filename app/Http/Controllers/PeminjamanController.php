<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// use App\Models\Kategori;
// use App\Models\Aset;
// use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // UNTUK ADMIN
        if ($user->role === 'admin') {
            
            return view('admin.peminjaman.index');
        } 
        
        // UNTUK PENGGUNA
        elseif ($user->role === 'pengguna') {
            return view('pengguna.peminjaman.index');
        } 
        
        else {
            abort(403, 'Unauthorized');
        }
    
    }
}
