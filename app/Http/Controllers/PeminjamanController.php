<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// use App\Models\Kategori;
use App\Models\Aset;
use Illuminate\Http\Request;
use App\Models\Peminjaman;


class PeminjamanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // PEMINJAMAN UNTUK ADMIN
        if ($user->role === 'admin') {
            try {
                $peminjamans = Peminjaman::with(['user', 'aset'])->get();
            } catch (\Exception $e) {
                $peminjamans = collect(); 
            }
            // Langsung lempsar ke view peminjaman.index
            return view('admin.peminjaman.index', compact('peminjamans'));
        }
        
        // UNTUK PENGGUNA
        elseif ($user->role === 'pengguna') {
            $asets = Aset::all();
            $peminjamans = Peminjaman::where('user_id', $user->id)
                                ->with('aset')
                                ->latest()
                                ->get();
            return view('pengguna.peminjaman.index',compact('asets', 'peminjamans'));
        } 
        
        else {
            abort(403, 'Unauthorized');
        }
    
    }


    public function create()
    {
        $asets = Aset::all(); 
        return view('pengguna.peminjaman.create', compact('asets'));
    }

    public function store(Request $request)
{
    // 1. Validasi hanya data yang dikirim dari FORM
    $validated = $request->validate([
        'aset_id' => 'required|exists:asets,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    ]);


    $validated['user_id'] = auth()->id(); 
    $validated['status_peminjaman'] = 'pending'; 
    $validated['status_ketersediaan'] = 'tersedia';

    Peminjaman::create($validated);
    return redirect()->route('pengguna.peminjaman.index')->with('success', 'Data berhasil disimpan!');
}


    // UPDATE STATUS PEMINJAMAN
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak,selesai',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        
        $peminjaman->status_peminjaman = $request->status;

        if ($request->status === 'disetujui') {
            $peminjaman->status_ketersediaan = 'dipinjam';
        } elseif ($request->status === 'selesai' || $request->status === 'ditolak') {
            $peminjaman->status_ketersediaan = 'tersedia';
        }

        $peminjaman->save();

        return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui!');
    }

}
