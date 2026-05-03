<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-2xl mx-auto">
        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-8 text-center">
            <div class="w-20 h-20 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            
            <h2 class="text-2xl font-black text-gray-800">Sedang Diverifikasi</h2>
            <p class="text-sm text-gray-500 mt-2 px-10">Permohonan kamu sedang diperiksa oleh admin. Tunggu maksimal 24 jam untuk pembaruan status.</p>

            <div class="mt-10 pt-10 border-t border-dashed border-gray-100 text-left space-y-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400 uppercase tracking-tighter font-bold">Nama Barang</span>
                    <span class="font-bold text-gray-700">Sony A7III</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400 uppercase tracking-tighter font-bold">Estimasi Selesai</span>
                    <span class="font-bold text-[#588133]">Besok, 14:00 WIB</span>
                </div>
            </div>

            <a href="{{ route('pengguna.peminjaman.index') }}" class="block mt-10 text-sm font-bold text-gray-400 hover:text-gray-600 uppercase tracking-widest">Tutup</a>
        </div>
    </div>
</x-app-layout>