<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara meminjam aset?',
                'answer' => 'Anda dapat meminjam aset melalui halaman "Form Peminjaman Baru". Pilih aset yang ingin dipinjam, tentukan durasi peminjaman, kemudian submit form. Admin akan memproses permohonan Anda.',
            ],
            [
                'question' => 'Berapa lama waktu peminjaman maksimal?',
                'answer' => 'Durasi peminjaman maksimal adalah 2 minggu. Jika Anda membutuhkan perpanjangan, silakan hubungi admin.',
            ],
            [
                'question' => 'Apa yang harus saya lakukan jika aset rusak?',
                'answer' => 'Segera laporkan kerusakan melalui halaman "Lapor Kerusakan Alat". Berikan deskripsi detail tentang kerusakan dan upload foto bukti. Kami akan segera menangani laporan Anda.',
            ],
            [
                'question' => 'Bagaimana proses pengembalian aset?',
                'answer' => 'Setelah masa peminjaman berakhir, kembalikan aset ke lokasi yang telah ditentukan. Admin akan melakukan verifikasi kondisi aset sebelum peminjaman ditandai selesai.',
            ],
            [
                'question' => 'Apakah ada biaya untuk peminjaman aset?',
                'answer' => 'Tidak ada biaya untuk peminjaman aset. Namun, jika aset rusak atau hilang karena kelalaian peminjam, akan ada penggantian biaya sesuai nilai aset.',
            ],
            [
                'question' => 'Bagaimana cara melihat history peminjaman saya?',
                'answer' => 'Anda dapat melihat riwayat peminjaman di halaman "Beranda" dengan bagian "Riwayat Peminjaman Anda".',
            ],
            [
                'question' => 'Siapa yang bisa mengakses sistem ini?',
                'answer' => 'Sistem dapat diakses oleh Pengguna (staff/mahasiswa), Admin, dan Stakeholder yang memiliki akun terdaftar.',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
