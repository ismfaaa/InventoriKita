<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Documentation;

class DocumentationSeeder extends Seeder
{
    public function run(): void
    {
        $docs = [
            [
                'title' => 'Panduan Memulai InventoriKita',
                'description' => 'Panduan lengkap untuk pengguna baru dalam menggunakan sistem InventoriKita',
                'content' => 'Selamat datang di InventoriKita!

InventoriKita adalah sistem manajemen inventaris yang dirancang untuk membantu pengelolaan aset, peminjaman barang, dan pelaporan kerusakan di institusi Anda.

FITUR UTAMA:
1. Manajemen Inventaris - Tambah, edit, dan kelola data aset
2. Peminjaman Barang - Proses peminjaman dan pengembalian aset
3. Pelaporan Kerusakan - Laporkan kerusakan aset untuk ditindaklanjuti
4. Ekspor Data - Ekspor laporan dalam format PDF, Excel, atau CSV
5. Dokumentasi - Akses panduan penggunaan sistem

CARA MENGGUNAKAN:
- Lakukan login dengan akun Anda
- Pilih menu sesuai dengan peran Anda (Pengguna, Admin, atau Stakeholder)
- Ikuti instruksi di setiap halaman untuk melakukan aksi',
                'version' => '1.0',
                'file_name' => 'Panduan_Memulai.pdf',
            ],
            [
                'title' => 'Tata Cara Peminjaman Aset',
                'description' => 'Panduan lengkap tata cara meminjam aset melalui sistem InventoriKita',
                'content' => 'TATA CARA PEMINJAMAN ASET

1. PERSIAPAN PEMINJAMAN:
   - Login ke sistem dengan akun Anda
   - Pastikan Anda memiliki izin untuk meminjam aset
   - Siapkan identitas diri dan informasi peminjaman

2. PROSES PEMINJAMAN:
   - Masuk ke menu "Form Peminjaman Baru"
   - Pilih aset yang ingin dipinjam
   - Tentukan tanggal peminjaman dan pengembalian
   - Isi kolom keterangan/keperluan (opsional)
   - Klik tombol "Ajukan Peminjaman"

3. PERSETUJUAN:
   - Admin akan mereview permohonan Anda
   - Notifikasi akan dikirim ketika permohonan disetujui atau ditolak
   - Ambil aset sesuai jadwal yang telah disepakati

4. PENGEMBALIAN:
   - Kembalikan aset tepat waktu pada tanggal yang telah ditentukan
   - Pastikan aset dalam kondisi baik
   - Serah terima akan diverifikasi oleh admin

KETENTUAN PENTING:
- Durasi peminjaman maksimal: 2 minggu
- Aset harus dikembalikan dalam kondisi baik
- Jika terjadi kerusakan, segera laporkan kepada admin',
                'version' => '1.0',
                'file_name' => 'Tata_Cara_Peminjaman.pdf',
            ],
            [
                'title' => 'Tata Cara Pelaporan Kerusakan',
                'description' => 'Panduan untuk melaporkan kerusakan aset yang Anda gunakan',
                'content' => 'TATA CARA PELAPORAN KERUSAKAN ASET

KAPAN PERLU MELAPOR:
- Aset mengalami kerusakan saat Anda menggunakannya
- Menemukan aset dalam kondisi rusak
- Kerusakan terjadi setelah aset dipinjam

CARA MELAPORKAN:
1. Login ke sistem InventoriKita
2. Pilih menu "Lapor Kerusakan Alat"
3. Klik tombol "Laporan Kerusakan Baru"
4. Isi informasi berikut:
   - Pilih aset yang rusak
   - Tentukan tingkat kerusakan (Ringan/Sedang/Berat)
   - Isi lokasi kerusakan (di mana aset digunakan)
   - Deskripsikan kerusakan dengan detail
   - Upload foto bukti kerusakan (JPG/PNG, maks 2MB)
5. Klik tombol "Kirim Laporan"

TINGKATAN KERUSAKAN:
- RINGAN: Aset masih bisa digunakan tapi ada bagian minor yang rusak
- SEDANG: Aset masih bisa digunakan tapi fungsi terganggu
- BERAT: Aset tidak bisa digunakan sama sekali

PROSES SETELAH MELAPOR:
1. Admin akan menerima laporan Anda
2. Laporan akan diverifikasi dan ditindaklanjuti
3. Anda akan menerima notifikasi tentang status penanganan
4. Tim akan melakukan perbaikan atau penggantian

PENTING:
- Selalu sertakan foto bukti kerusakan
- Deskripsi yang jelas membantu proses verifikasi
- Jangan coba memperbaiki sendiri sebelum dilaporkan',
                'version' => '1.0',
                'file_name' => 'Tata_Cara_Pelaporan.pdf',
            ],
            [
                'title' => 'Kebijakan Pemeliharaan Aset',
                'description' => 'Kebijakan dan aturan pemeliharaan serta tanggung jawab pengguna aset',
                'content' => 'KEBIJAKAN PEMELIHARAAN ASET

TANGGUNG JAWAB PEMINJAM:
1. Menjaga kondisi aset selama peminjaman
2. Menggunakan aset sesuai dengan petunjuk penggunaan
3. Melaporkan kerusakan atau masalah segera
4. Mengembalikan aset tepat waktu dalam kondisi baik
5. Tidak mengalihkan kepemilikan atau menyewakan kembali aset

LARANGAN:
- Dilarang memperbaiki aset sendiri tanpa izin
- Dilarang membongkar atau memodifikasi aset
- Dilarang meminjamkan kembali kepada orang lain
- Dilarang menggunakan aset untuk hal yang tidak sesuai

SANKSI PELANGGARAN:
1. Kerusakan karena kelalaian: Biaya perbaikan/penggantian ditanggung peminjam
2. Keterlambatan pengembalian: Denda sesuai peraturan institusi
3. Hilang atau tidak dikembalikan: Penggantian biaya penuh aset
4. Pelanggaran berulang: Dapat dicabut hak peminjaman

BIAYA PENGGANTIAN:
- Biaya penggantian akan dihitung berdasarkan nilai aset terbaru
- Invoice akan dikirim setelah verifikasi kerusakan
- Pembayaran dapat dilakukan melalui rekening yang ditentukan

KLAIM ASURANSI:
- Kerusakan berat dapat diajukan klaim asuransi
- Dokumen pendukung harus lengkap dan jelas
- Proses klaim melalui admin/stakeholder',
                'version' => '1.0',
                'file_name' => 'Kebijakan_Pemeliharaan.pdf',
            ],
        ];

        foreach ($docs as $doc) {
            Documentation::create($doc);
        }
    }
}
