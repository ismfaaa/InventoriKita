<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Pusat Keputusan Operasional') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800">Menunggu Persetujuan</h3>
            <p class="text-sm text-gray-500">Daftar inventaris yang memerlukan tindakan lanjut terkait kerusakan.</p>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white p-6 rounded-[30px] shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="p-4 bg-red-50 rounded-2xl">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 text-lg">Kamera Sony A6400</h4>
                        <p class="text-sm text-gray-500">Laporan: Sensor Berjamur & Shutter Rusak</p>
                        <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">Rusak Berat</span>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    <button class="bg-[#588133] text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-[#466629]">
                        Perbaiki
                    </button>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-blue-600">
                        Ganti Baru
                    </button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-600">
                        Buang (Lelang/Hapus)
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>