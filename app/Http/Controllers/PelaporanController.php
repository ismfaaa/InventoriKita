<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        try {
            // 2. Mulai query dasar (Load relasi aset dan user)
            $query = Pelaporan::with(['aset', 'user']);

            // 3. KUNCI DATA: Jika role pengguna, HANYA tampilkan laporannya sendiri
            if ($user->role === 'pengguna') {
                $query->where('user_id', $user->id);
            }

            // 4. FITUR SEARCH (Cari berdasarkan Aset, Lokasi, atau Nama Pelapor)
            if ($request->filled('search')) {
                $search = $request->get('search');
                $query->where(function($q) use ($search, $user) {
                    
                    // Semua role bisa mencari nama aset...
                    $q->whereHas('aset', function($asetQuery) use ($search) {
                        $asetQuery->where('nama_aset', 'like', '%' . $search . '%');
                    })
                    // ...atau mencari berdasarkan lokasi
                    ->orWhere('lokasi', 'like', '%' . $search . '%');
                    
                    // HANYA Admin dan Stakeholder yang bisa mencari nama pelapor
                    if (in_array($user->role, ['admin', 'stakeholder'])) {
                        $q->orWhereHas('user', function($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%');
                        });
                    }
                });
            }

            // 5. FITUR FILTER STATUS PELAPORAN
            if ($request->filled('status_pelaporan')) {
                $query->where('status_pelaporan', $request->get('status_pelaporan'));
            }

            // 6. FITUR FILTER TINGKAT KERUSAKAN
            if ($request->filled('tingkat_kerusakan')) {
                $query->where('tingkat_kerusakan', $request->get('tingkat_kerusakan'));
            }

            // 7. PAGINATION
            $pelaporans = $query->latest('created_at')->paginate(5);
            $asets = Aset::all(); // Dibutuhkan jika view pengguna ingin buat laporan baru

        } catch (\Exception $e) {
            // Jaring pengaman jika database error
            $pelaporans = collect();
            $asets = Aset::all();
        }

        // 8. TERTUJU KEPADA VIEWS
        if ($user->role === 'admin') {
            return view('admin.pelaporan.index', compact('pelaporans'));
        } elseif ($user->role === 'stakeholder') {
            return view('stakeholder.pelaporan.index', compact('pelaporans'));
        } 
        

        return view('pengguna.pelaporan.index', compact('pelaporans', 'asets'));
    }


    

 
    public function create()
    
    {
        $asets = Aset::all();
        return view('pengguna.pelaporan.create', compact('asets'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'aset_id'           => 'required|exists:asets,id',
            'tingkat_kerusakan' => 'required|in:ringan,sedang,berat',
            'lokasi'            => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'foto'              => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

    $laporanAda = Pelaporan::where('aset_id', $request->aset_id)
        ->whereIn('status_pelaporan', ['diproses']) 
        ->first();

    if ($laporanAda) {
        return redirect()->back()
            ->withInput() 
            ->with('error_kritis', 'Aset ini sudah dilaporkan sebelumnya dan sedang dalam penanganan.');
    }

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pelaporan', 'public');
            $data['foto'] = $path;
        }

        $data['user_id'] = Auth::id();
        $data['status_pelaporan'] = 'diproses';
        $data['tanggal_pelaporan'] = now();

        Pelaporan::create($data);

        return redirect()->route('pengguna.lapor.index')->with('status_berhasil', 'Laporan kerusakan berhasil dikirim!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pelaporan' => 'required|in:diproses,verifikasi,feedback,selesai',
            'feedback' => 'nullable|in:diperbaiki,diganti,dihilangkan',
        ]);

        $laporan = Pelaporan::findOrFail($id);
        $laporan->status_pelaporan = $request->status_pelaporan;

        if ($request->has('feedback')) {
            $laporan->feedback = $request->feedback;
        }

        $laporan->save();
        $user = Auth::user();

        if ($user->role === 'stakeholder') {
            return redirect()->route('feedback.pelaporan.index')->with('success', 'Feedback berhasil diberikan!');
        }
        return redirect()->route('manajemen.pelaporan.index')->with('success', 'Status laporan berhasil diperbarui!');
    }

    public function show($id)
    {
        $laporan = Pelaporan::with(['aset', 'user'])->findOrFail($id);

        return view('stakeholder.pelaporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelaporan $pelaporan)
    {
        //
    }
}
