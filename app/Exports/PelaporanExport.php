<?php

namespace App\Exports;

use App\Models\Pelaporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PelaporanExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $user = Auth::user();
        $query = Pelaporan::with(['aset', 'user']);

        if ($user->role === 'stakeholder') {
            $query->where('status_pelaporan', 'feedback');
        } elseif ($user->role === 'admin') {
            if ($this->request->filled('status')) {
                $query->where('status_pelaporan', $this->request->status);
            }
            if ($this->request->filled('tingkat_kerusakan')) {
                $query->where('tingkat_kerusakan', $this->request->tingkat_kerusakan);
            }
        }

        $pelaporans = $query->get();

        return $pelaporans->map(function ($pelaporan) {
            return [
                'ID' => $pelaporan->id,
                'Nama Aset' => $pelaporan->aset->nama_aset ?? 'N/A',
                'Tanggal Laporan' => \Carbon\Carbon::parse($pelaporan->tanggal_pelaporan)->format('d M Y'),
                'Tingkat Kerusakan' => ucfirst($pelaporan->tingkat_kerusakan),
                'Status' => ucfirst($pelaporan->status_pelaporan),
                'Feedback' => $pelaporan->feedback ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Aset',
            'Tanggal Laporan',
            'Tingkat Kerusakan',
            'Status',
            'Feedback',
        ];
    }
}
