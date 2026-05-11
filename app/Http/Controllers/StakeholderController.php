<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Pelaporan;
use App\Models\Pengadaan;
// use Illuminate\Http\Request;

class StakeholderController extends Controller
{
    public function index()
    {
        $totalPending = Pengadaan::where('status_pengadaan', 'pending')->count();
        $totalAsetBaru = Pengadaan::where('feedback_pengadaan', 'disetujui')->count();

        $pelaporans = Pelaporan::all();
        $totalDiperbaiki = $pelaporans->where('feedback', 'diperbaiki')->count();
        $totalDiganti = $pelaporans->where('feedback', 'diganti')->count();
        $totalTerverifikasi = $pelaporans->where('status_pelaporan', 'verifikasi')->count();
        $totalBerat = $pelaporans->where('tingkat_kerusakan', 'berat')->count();
        $totalSedang = $pelaporans->where('tingkat_kerusakan', 'sedang')->count();
        $totalRingan = $pelaporans->where('tingkat_kerusakan', 'ringan')->count();
        

        return view('stakeholder.index', compact('totalPending', 'totalAsetBaru', 'totalDiperbaiki', 'totalDiganti', 'totalTerverifikasi', 'totalBerat', 'totalSedang', 'totalRingan'));
    }
}
