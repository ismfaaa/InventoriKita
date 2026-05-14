<?php

namespace App\Exports;

use App\Models\Aset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AsetExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Aset::with('kategori');

        if ($this->request->filled('kategori_id')) {
            $query->where('kategori_id', $this->request->kategori_id);
        }

        $asets = $query->get();

        return $asets->map(function ($aset) {
            return [
                'Kode Aset' => $aset->kode_aset,
                'Nama Aset' => $aset->nama_aset,
                'Kategori' => $aset->kategori->nama_kategori ?? 'N/A',
                'Lokasi' => $aset->lokasi,
                'Tanggal Dibuat' => \Carbon\Carbon::parse($aset->created_at)->format('d M Y'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Aset',
            'Nama Aset',
            'Kategori',
            'Lokasi',
            'Tanggal Dibuat',
        ];
    }
}
