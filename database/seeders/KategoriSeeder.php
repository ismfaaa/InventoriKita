<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Alat Multimedia', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'nama_kategori' => 'Perangkat IT', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'nama_kategori' => 'Kelistrikan & Jaringan', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'nama_kategori' => 'Furnitur & Fasilitas', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table('kategoris')->insert($kategoris);
    }
}