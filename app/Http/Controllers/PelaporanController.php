<?php

namespace App\Http\Controllers;

use App\Models\Pelaporan;  // Jika nama modelnya Laporan, silakan ganti menjadi App\Models\Laporan
use App\Models\Kategori;   // Model kategori untuk kebutuhan filter data
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    /**
     * Menampilkan semua daftar laporan (Halaman Index Stakeholder)
     */
    public function index(Request $request)
    {
        // Query dasar mengambil data pelaporan terbaru beserta kategorinya
        $query = Pelaporan::with('kategori')->latest();

        // Fitur Pencarian laporan
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter berdasarkan Kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('kategori_id', $request->category);
        }

        // Ambil data pelaporan dengan pagination (5 data per halaman)
        $pelaporans = $query->paginate(5);
        
        // Ambil semua kategori untuk kebutuhan dropdown/filter di view index
        $kategoris = Kategori::all();

        // Mengarah ke file index di dalam folder stakeholder/pelaporan
        return view('stakeholder.pelaporan.index', compact('pelaporans', 'kategoris'));
    }

   
    public function show($id)
    {
        // 1. Ambil detail data pelaporan berdasarkan ID
        $laporan = Pelaporan::with('kategori')->findOrFail($id);
        
        // 2. AMBIL FEEDBACK DENGAN PAGINATION (Kunci Utama):
        $feedbacks = $laporan->feedbacks()->latest()->paginate(5); 

        // 3. Lempar data laporan dan feedbacks ke view show
        return view('stakeholder.pelaporan.show', compact('laporan', 'feedbacks'));
    }

    /**
     * Menyimpan feedback/tanggapan baru dari stakeholder/admin
     */
    public function storeFeedback(Request $request, $laporanId)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string|max:1000',
        ]);

        $laporan = Pelaporan::findOrFail($laporanId);
        
        // Simpan feedback baru dengan relasi user yang sedang login
        $laporan->feedbacks()->create([
            'user_id' => auth()->id(),
            'isi_tanggapan' => $request->isi_tanggapan,
        ]);

        return redirect()->route('pelaporan.show', $laporanId)
                         ->with('status', 'Feedback atau tanggapan berhasil dikirim!');
    }
}