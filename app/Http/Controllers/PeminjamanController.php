<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kategori;
use App\Models\Aset;
use Illuminate\Http\Request;
use App\Models\Peminjaman;



class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        
        $user = auth()->user();

        // PEMINJAMAN UNTUK ADMIN
        if ($user->role === 'admin') {
            try {
                $query = Peminjaman::with(['user', 'aset', 'aset.Kategori']);
                
                // Search
                if ($request->filled('search')) {
                    $search = $request->get('search');
                    $query->where(function($q) use ($search) {
                        $q->whereHas('user', function($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('aset', function($asetQuery) use ($search) {
                            $asetQuery->where('nama_aset', 'like', '%' . $search . '%');
                        });
                    });
                }
                
                // Filter by Status
                if ($request->filled('status')) {
                    $query->where('status_peminjaman', $request->get('status'));
                }
                
                // Filter by Category
                if ($request->filled('kategori')) {
                    $query->whereHas('aset', function($asetQuery) {
                        $asetQuery->where('kategori_id', request()->get('kategori'));
                    });
                }
                
                $peminjamans = $query->latest('created_at')->paginate(10);
                $kategoris = Kategori::all();
            } catch (\Exception $e) {
                $peminjamans = collect(); 
                $kategoris = Kategori::all();
            }
            // Langsung lempsar ke view peminjaman.index
            return view('admin.peminjaman.index', compact('peminjamans', 'kategoris'));
        }
        
        // UNTUK PENGGUNA
        elseif ($user->role === 'pengguna') {
        $query = Peminjaman::where('user_id', $user->id)->with(['aset', 'aset.kategori']);

        // Logika Search
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->whereHas('aset', function($asetQuery) use ($search) {
                $asetQuery->where('nama_aset', 'like', '%' . $search . '%');
            });
        }
        
        // Logika Filter Status
        if ($request->filled('status')) {
            $query->where('status_peminjaman', $request->get('status'));
        }
        
        // Logika Filter Kategori
        if ($request->filled('kategori')) {
            $query->whereHas('aset', function($asetQuery) use ($request) {
                $asetQuery->where('kategori_id', $request->get('kategori'));
            });
        }
        
        $peminjamans = $query->latest('created_at')->paginate(10);
        $asets = Aset::all();
        $kategoris = Kategori::all();
        
        return view('pengguna.peminjaman.index', compact('asets', 'peminjamans', 'kategoris'));
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

    public function show($id)
    {
        $peminjamans = Peminjaman::with('aset')->findOrFail($id);
        return view('pengguna.peminjaman.show', compact('peminjamans'));
    }
}
