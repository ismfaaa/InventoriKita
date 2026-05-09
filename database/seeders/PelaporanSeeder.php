<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelaporan;
use Carbon\Carbon;

class PelaporanSeeder extends Seeder
{
    public function run(): void
    {
        $pelaporans = [
            [
                'user_id' => 2, 
                'aset_id' => 1, 
                'status_pelaporan' => 'diproses',
                'tingkat_kerusakan' => 'ringan',
                'lokasi' => 'Lab Komputer 1',
                'deskripsi' => 'Mouse tidak terdeteksi oleh PC saat dicolok.',
                'foto' => null,
                'tanggal_pelaporan' => Carbon::now()->subDays(1),
            ],
            [
                'user_id' => 2,
                'aset_id' => 2,
                'status_pelaporan' => 'verifikasi',
                'tingkat_kerusakan' => 'sedang',
                'lokasi' => 'Ruang Server',
                'deskripsi' => 'UPS sering bunyi beep terus menerus padahal listrik stabil.',
                'foto' => null,
                'tanggal_pelaporan' => Carbon::now()->subDays(3),
            ],
            [
                'user_id' => 2,
                'aset_id' => 3,
                'status_pelaporan' => 'selesai',
                'tingkat_kerusakan' => 'berat',
                'lokasi' => 'SmartRoom',
                'deskripsi' => 'Proyektor mati total, tidak ada lampu indikator yang menyala.',
                'foto' => null,
                'tanggal_pelaporan' => Carbon::now()->subDays(7),
                'feedback' => 'diganti',
            ],
        ];

        foreach ($pelaporans as $pelaporan) {
            Pelaporan::create($pelaporan);
        }
    }
}