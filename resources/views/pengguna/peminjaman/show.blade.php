<x-app-layout>
    @include('layouts.sidebar')
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-2xl mx-auto">
        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-8 text-center">
            <div class="w-20 h-20 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
           
            <h2 class="text-2xl font-black text-gray-800">
                @if ($peminjamans->status_peminjaman === 'pending')
                    Permohonan Peminjaman Sedang Diproses
                @elseif ($peminjamans->status_peminjaman === 'disetujui')
                    Permohonan Peminjaman Disetujui
                @elseif ($peminjamans->status_peminjaman === 'ditolak')
                    Permohonan Peminjaman Ditolak
                @elseif ($peminjamans->status_peminjaman === 'selesai')
                    Permohonan Peminjaman Selesai
                @endif
            </h2>
            <p class="text-sm text-gray-500 mt-2 px-10">
                @if ($peminjamans->status_peminjaman === 'pending')
                    Permohonan kamu sedang diperiksa oleh admin. Tunggu maksimal 24 jam untuk pembaruan status.
                @elseif ($peminjamans->status_peminjaman === 'disetujui')
                    Permohonan Peminjaman kamu Disetujui, silahkan ambil barang di {{ $peminjamans->lokasi }}dan pastikan untuk mengembalikan tepat waktu.
                @elseif ($peminjamans->status_peminjaman === 'ditolak')
                    Permohonan Peminjaman kamu Ditolak karena aset sedang digunakan untuk keperluan lain. Silahkan ajukan peminjaman ulang di lain waktu.
                @elseif ($peminjamans->status_peminjaman === 'selesai')
                    Permohonan Peminjaman Selesai. Terimakasih sudah mengembalikan aset tepat waktu. Jangan lupa untuk selalu merawat aset yang kamu pinjam agar tetap dalam kondisi baik.
                @endif
            </p>

            <div class="mt-10 pt-10 border-t border-dashed border-gray-100 text-left space-y-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400 uppercase tracking-tighter font-bold">{{ $peminjamans->aset->nama_aset }}</span>
                    <span class="font-bold text-gray-700">{{  $peminjamans->aset->kode_aset }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    
                        @if ($peminjamans->status_peminjaman === 'selesai')
                            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                                <p class="text-green-700 text-sm">
                                    <span class="font-bold">✓ Terverifikasi:</span> Barang sudah diterima kembali oleh admin pada 
                                    {{ \Carbon\Carbon::parse($peminjamans->updated_at)->translatedFormat('d M Y, H:i') }} WIB.
                                </p>
                            </div>
                        @else
                        
                            <span class="text-gray-400 uppercase tracking-tighter font-bold">Ambil barang maksimal pada </span>
                            <span class="font-bold text-[#588133]">
                                {{ \Carbon\Carbon::parse($peminjamans->tanggal_pinjam)->translatedFormat('d M Y') }}
                            </span>
                        
                        @endif                   
                </div>
            </div>

            <a href="{{ route('pengguna.peminjaman.index') }}" class="block mt-10 text-sm font-bold text-gray-400 hover:text-gray-600 uppercase tracking-widest">Tutup</a>
        </div>
    </div>
</x-app-layout>