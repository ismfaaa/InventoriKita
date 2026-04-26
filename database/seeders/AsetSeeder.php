<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aset;

class AsetSeeder extends Seeder
{
    public function run(): void
    {
       // Informasi id kategori:
            // 1 = Alat Multimedia
            // 2 = Perangkat IT
            // 3 = Kelistrikan & Jaringan
            // 4 = Furnitur & Fasilitas 

        $asets = [
            // --- 1. Alat Multimedia (Kategori ID: 1) ---
            [
                'kode_aset'   => 'AMPE-001',
                'nama_aset'   => 'Proyektor Epson EB-X06',
                'kategori_id' => 1,
                'lokasi'      => 'Lemari Multimedia, Rak A',
                'foto'        => 'asets/ampe-001.jpg', 
            ],
            [
                'kode_aset'   => 'AMPE-002',
                'nama_aset'   => 'Proyektor_Acer_EV_x80H',
                'kategori_id' => 1,
                'lokasi'      => 'Lemari Multimedia, Rak A',
                'foto'        => 'asets/ampa-001.jpg',
            ],
            [
                'kode_aset'   => 'AMKS-001',
                'nama_aset'   => 'Kamera Mirrorless Sony A6400',
                'kategori_id' => 1,
                'lokasi'      => 'Brankas Kamera',
                'foto'        => 'asets/amks-001.jpg',
            ],

            // --- 2. Perangkat IT (Kategori ID: 2) ---
            [
                'kode_aset'   => 'ITML-001',
                'nama_aset'   => 'Mouse Wireless Logitech M170',
                'kategori_id' => 2,
                'lokasi'      => 'Loker Asisten Lab',
                'foto'        => 'asets/itml-001.jpg',
            ],
            [
                'kode_aset'   => 'ITKL-001',
                'nama_aset'   => 'Keyboard USB Logitech K120',
                'kategori_id' => 2,
                'lokasi'      => 'Gudang IT',
                'foto'        => 'asets/itkl-001.jpg',
            ],

            // --- 3. Kelistrikan & Jaringan (Kategori ID: 3) ---
            [
                'kode_aset'   => 'KJRM-001',
                'nama_aset'   => 'Routerboard MikroTik RB941 (hAP lite)',
                'kategori_id' => 3,
                'lokasi'      => 'Rak Server Utama',
                'foto'        => 'asets/kjrm-001.jpg',
            ],
            [
                'kode_aset'   => 'KJRM-002',
                'nama_aset'   => 'Routerboard MikroTik RB751U-2HnD',
                'kategori_id' => 3,
                'lokasi'      => 'Rak Server Utama',
                'foto'        => 'asets/kjrm-002.jpg',
            ],
            [
                'kode_aset'   => 'KJKV-001',
                'nama_aset'   => 'Kabel HDMI Vention',
                'kategori_id' => 3,
                'lokasi'      => 'Laci Kabel 1',
                'foto'        => 'asets/kjkv-001.jpg',
            ],

            // --- 4. Furnitur & Fasilitas (Kategori ID: 4) ---
            [
                'kode_aset'   => 'FFSK-001',
                'nama_aset'   => 'Sofa Kulit Coklat 3-Seater',
                'kategori_id' => 4,
                'lokasi'      => 'Ruang Tunggu Lab',
                'foto'        => 'asets/ffsc-001.jpg',
            ],
            [
                'kode_aset'   => 'FFLP-001',
                'nama_aset'   => 'Layar Proyektor Tripod 70 Inch',
                'kategori_id' => 4,
                'lokasi'      => 'Sudut Ruang Kelas A',
                'foto'        => 'asets/fflp-001.jpg',
            ],
            [
                'kode_aset'   => 'FFKL-001',
                'nama_aset'   => 'Kursi Kuliah',
                'kategori_id' => 4,
                'lokasi'      => 'Meja Komputer 01',
                'foto'        => 'asets/ffkl-001.jpg',
            ],
        ];

        // Looping untuk memasukkan data ke database
        foreach ($asets as $aset) {
            Aset::create($aset);
        }
    }
}