<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function index()
    {
        return view('admin.export.index');
    }

    public function exportPelaporanPdf(Request $request)
    {
        $user = Auth::user();

        // Query dasar
        $query = Pelaporan::with(['aset', 'user']);

        // Filter berdasarkan role
        if ($user->role === 'stakeholder') {
            // Stakeholder hanya lihat yang perlu keputusan, misal status feedback
            $query->where('status_pelaporan', 'feedback');
        } elseif ($user->role === 'admin') {
            // Admin bisa filter
            if ($request->filled('status')) {
                $query->where('status_pelaporan', $request->status);
            }
            if ($request->filled('tingkat_kerusakan')) {
                $query->where('tingkat_kerusakan', $request->tingkat_kerusakan);
            }
            if ($request->filled('tanggal_dari')) {
                $query->whereDate('tanggal_pelaporan', '>=', $request->tanggal_dari);
            }
            if ($request->filled('tanggal_sampai')) {
                $query->whereDate('tanggal_pelaporan', '<=', $request->tanggal_sampai);
            }
        }

        $pelaporans = $query->get();

        // Data untuk PDF
        $data = [
            'pelaporans' => $pelaporans,
            'title' => 'Laporan Kerusakan Aset',
            'tanggal' => now()->format('d M Y'),
        ];

        $pdf = Pdf::loadView('exports.pelaporan_pdf', $data);

        return $pdf->download('laporan_kerusakan_' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportPengadaanPdf(Request $request)
    {
        $user = Auth::user();

        // Query dasar
        $query = \App\Models\Pengadaan::with(['aset', 'user']);

        // Filter berdasarkan role
        if ($user->role === 'admin') {
            if ($request->filled('status')) {
                $query->where('status_pengadaan', $request->status);
            }
            if ($request->filled('tanggal_dari')) {
                $query->whereDate('tanggal_pengadaan', '>=', $request->tanggal_dari);
            }
            if ($request->filled('tanggal_sampai')) {
                $query->whereDate('tanggal_pengadaan', '<=', $request->tanggal_sampai);
            }
        }

        $pengadaans = $query->get();

        // Data untuk PDF
        $data = [
            'pengadaans' => $pengadaans,
            'title' => 'Usulan Pengadaan Aset',
            'tanggal' => now()->format('d M Y'),
        ];

        $pdf = Pdf::loadView('exports.pengadaan_pdf', $data);

        return $pdf->download('usulan_pengadaan_' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportAsetPdf(Request $request)
    {
        $user = Auth::user();

        // Query dasar
        $query = \App\Models\Aset::with('kategori');

        // Filter untuk admin
        if ($user->role === 'admin') {
            if ($request->filled('kategori_id')) {
                $query->where('kategori_id', $request->kategori_id);
            }
            // Tambah filter lain jika perlu
        }

        $asets = $query->get();

        // Data untuk PDF
        $data = [
            'asets' => $asets,
            'title' => 'Data Aset Inventori',
            'tanggal' => now()->format('d M Y'),
        ];

        $pdf = Pdf::loadView('exports.aset_pdf', $data);

        return $pdf->download('data_aset_' . now()->format('Y-m-d') . '.pdf');
    }
}