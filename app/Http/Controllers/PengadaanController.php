<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PengadaanController extends Controller
{
  public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $status_pengadaan = $request->query('status_pengadaan');
        $feedback_pengadaan = $request->query('feedback_pengadaan');

        if ($user->role === 'admin') {
            $pengadaans = Pengadaan::with(['aset', 'user'])
                ->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->whereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('aset', function ($asetQuery) use ($search) {
                            $asetQuery->where('nama_aset', 'like', '%' . $search . '%');
                        })
                        ->orWhere('estimasi_biaya', 'like', '%' . $search . '%')
                        ->orWhere('tanggal_pengadaan', 'like', '%' . $search . '%');
                    });
                })
                // Diubah menggunakan request()->filled() agar string kosong tidak merusak query utama
                ->when($request->filled('status_pengadaan'), function ($query) use ($status_pengadaan) {
                    return $query->where('status_pengadaan', $status_pengadaan);
                })
                ->when($request->filled('feedback_pengadaan'), function ($query) use ($feedback_pengadaan) {
                    return $query->where('feedback_pengadaan', $feedback_pengadaan);
                })
                ->latest()
                ->paginate(5)
                ->withQueryString();

            return view('admin.usulan.index', compact('pengadaans'));
        } 
        
        if ($user->role === 'stakeholder') {
            $pengadaans = Pengadaan::with(['aset', 'user'])
                ->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->whereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('aset', function ($asetQuery) use ($search) {
                            $asetQuery->where('nama_aset', 'like', '%' . $search . '%');
                        })
                        ->orWhere('estimasi_biaya', 'like', '%' . $search . '%')
                        ->orWhere('tanggal_pengadaan', 'like', '%' . $search . '%');
                    });
                })
                // Diubah menggunakan request()->filled() agar string kosong tidak merusak query utama
                ->when($request->filled('status_pengadaan'), function ($query) use ($status_pengadaan) {
                    return $query->where('status_pengadaan', $status_pengadaan);
                })
                ->when($request->filled('feedback_pengadaan'), function ($query) use ($feedback_pengadaan) {
                    return $query->where('feedback_pengadaan', $feedback_pengadaan);
                })
                ->latest()
                ->paginate(5)
                ->withQueryString();

            return view('stakeholder.pengadaan.index', compact('pengadaans'));
        }
        
        else {
            abort(403, 'Unauthorized');
        }
    }
    /**
     * Menampilkan halaman formulir
     */
    public function create()
    {
        $asets = Aset::all();
        return view('admin.usulan.create', compact('asets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required_without:nama_aset|nullable|exists:asets,id',
            'nama_aset' => 'required_without:aset_id|nullable|string|max:255',
            'kuantitas' => 'required|numeric|min:1',
            'estimasi_biaya' => 'required|numeric',
        ]);
        Pengadaan::create([
            'user_id' => Auth::id(),
            'aset_id' => $request->aset_id,
            'nama_aset' => $request->nama_aset,
            'kuantitas' => $request->kuantitas,
            'estimasi_biaya' => $request->estimasi_biaya,
            'status_pengadaan' => 'pending', // Default
            'tanggal_pengadaan' => now(),
        ]); 

        return redirect()->route('pengadaan.index')->with('status_berhasil', 'Usulan berhasil dibuat');
    }

    public function updateStatus(Request $request, $id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        $newStatus = $request->input('status');

        if (!in_array($newStatus, ['pending', 'selesai', 'disetujui', 'ditolak'])) {
            return redirect()->back()->with('status_gagal', 'Status tidak valid');
        }

        if ($newStatus == 'disetujui' || $newStatus == 'ditolak') {
            $pengadaan->feedback_pengadaan = $newStatus;
            $pengadaan->status_pengadaan = 'selesai';
        } else {
            $pengadaan->status_pengadaan = $newStatus;
        }
        
        $pengadaan->save();
        $user = Auth::user();

        $totalPending = Pengadaan::where('status_pengadaan', 'pending')->count();

        if ($user->role === 'stakeholder') {
            return redirect()->route('feedback.pengadaan.index')->with('success', 'Feedback berhasil diberikan!');
        }
        return redirect()->back()->with('status_berhasil', 'Status pengadaan berhasil diperbarui');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengadaan $pengadaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengadaan $pengadaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengadaan $pengadaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengadaan $pengadaan)
    {
        //
    }
}