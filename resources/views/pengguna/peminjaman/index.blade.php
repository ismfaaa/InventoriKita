<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        {{-- Notifikasi Berhasil --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-[#f1f5e9] border border-[#588133] text-[#588133] rounded-2xl flex items-center gap-3 animate-fade-in">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-bold text-sm">Permohonan berhasil dikirim!</span>
            </div>
        @endif

        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-black text-[#588133]">Riwayat Pinjam</h2>
                <p class="text-sm text-gray-500 mt-1">Status verifikasi dalam 24 jam</p>
            </div>
            {{-- Tombol (+) Masuk ke Halaman Create --}}
            <a href="{{ route('pengguna.peminjaman.create') }}" class="bg-[#588133] hover:bg-[#466629] text-white w-14 h-14 rounded-2xl shadow-lg flex items-center justify-center transition-all duration-300 transform hover:scale-105">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v12m6-6H6"/></svg>
            </a>
        </div>

        <div class="bg-white rounded-[35px] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#f1f5e9] text-[#588133] text-[10px] uppercase tracking-[0.2em] font-black">
                        <th class="p-6">Aset</th>
                        <th class="p-6">Tgl Pinjam</th>
                        <th class="p-6">Status</th>
                        <th class="p-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    {{-- Loop data nanti di sini --}}
                    <tr>
                        <td class="p-6 font-bold text-gray-800">Kamera Sony A7III</td>
                        <td class="p-6 text-sm text-gray-500">12 Feb 2024</td>
                        <td class="p-6">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-[10px] font-black uppercase">Pending</span>
                        </td>
                        <td class="p-6">
                            <a href="{{ route('pengguna.peminjaman.show', 1) }}" class="text-[#588133] font-bold text-xs hover:underline">Detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>