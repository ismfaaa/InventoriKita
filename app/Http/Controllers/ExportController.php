<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Exports\PelaporanExport;
use App\Exports\PengadaanExport;
use App\Exports\AsetExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function index()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('admin.export.index', compact('kategoris'));
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

    public function exportPelaporanExcel(Request $request)
    {
        return Excel::download(new PelaporanExport($request), 'laporan_kerusakan_' . now()->format('Y-m-d') . '.xlsx');
    }

    public function exportPelaporanCsv(Request $request)
    {
        return Excel::download(new PelaporanExport($request), 'laporan_kerusakan_' . now()->format('Y-m-d') . '.csv');
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

    public function exportPengadaanExcel(Request $request)
    {
        return Excel::download(new PengadaanExport($request), 'usulan_pengadaan_' . now()->format('Y-m-d') . '.xlsx');
    }

    public function exportPengadaanCsv(Request $request)
    {
        return Excel::download(new PengadaanExport($request), 'usulan_pengadaan_' . now()->format('Y-m-d') . '.csv');
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

    public function exportAsetExcel(Request $request)
    {
        return Excel::download(new AsetExport($request), 'data_aset_' . now()->format('Y-m-d') . '.xlsx');
    }

    public function exportAsetCsv(Request $request)
    {
        return Excel::download(new AsetExport($request), 'data_aset_' . now()->format('Y-m-d') . '.csv');
    }


    // Buat ekpor buku pedoman
    public function pedoman()
    {
        return view('pages.pedoman');
    }

    public function downloadBukuPedoman()
    {
        $filePath = public_path('files/ManualBook_InventoriKita.pdf');

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, 'ManualBook_InventoriKita.pdf');
    }











}