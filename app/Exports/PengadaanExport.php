<?php

namespace App\Exports;

use App\Models\Pengadaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PengadaanExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $user = Auth::user();
        $query = Pengadaan::with(['aset', 'user']);

        if ($user->role === 'admin') {
            if ($this->request->filled('status')) {
                $query->where('status_pengadaan', $this->request->status);
            }
        }

        $pengadaans = $query->get();

        return $pengadaans->map(function ($pengadaan) {
            return [
                'ID' => $pengadaan->id,
                'Nama Aset' => $pengadaan->aset->nama_aset ?? 'N/A',
                'Tanggal Usulan' => \Carbon\Carbon::parse($pengadaan->tanggal_pengadaan)->format('d M Y'),
                'Estimasi Biaya' => 'Rp ' . number_format($pengadaan->estimasi_biaya, 0, ',', '.'),
                'Status' => ucfirst($pengadaan->status_pengadaan),
                'Feedback' => $pengadaan->feedback_pengadaan ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Aset',
            'Tanggal Usulan',
            'Estimasi Biaya',
            'Status',
            'Feedback',
        ];
    }
}
