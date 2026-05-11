<?php

namespace App\Http\Controllers;
use App\Models\Pengadaan;
use App\Models\Pelaporan;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function index()
    {
        $totalPending = Pengadaan::where('status_pengadaan', 'pending')->count();
        $pelaporans = Pelaporan::all();

        $totalTerverifikasi = $pelaporans->where('status', 'verifikasi')->count();
        $totalBerat = $pelaporans->where('status', 'verifikasi')->where('tingkat_kerusakan', 'berat')->count();
        $totalSedang = $pelaporans->where('status', 'verifikasi')->where('tingkat_kerusakan', 'sedang')->count();
        $totalRingan = $pelaporans->where('status', 'verifikasi')->where('tingkat_kerusakan', 'ringan')->count();

        return view('stakeholder.widget', compact('totalPending', 'totalTerverifikasi', 'totalBerat', 'totalSedang', 'totalRingan'));
    }
}
