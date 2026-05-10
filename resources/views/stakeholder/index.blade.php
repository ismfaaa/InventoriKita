<x-app-layout>
    @include('layouts.sidebar')
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Pusat Keputusan Operasional') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[30px] border border-[#e5edda] shadow-sm flex items-center gap-4">
                <div class="p-4 bg-[#f8faf2] rounded-2xl">
                    <svg class="w-6 h-6 text-[#588133]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-[#588133] uppercase tracking-widest">Usulan Baru</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalPendingPengadaan ?? 0 }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[30px] border border-[#e5edda] shadow-sm flex items-center gap-4">
                <div class="p-4 bg-orange-50 rounded-2xl">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-orange-600 uppercase tracking-widest">Kerusakan Terverifikasi</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalTerverifikasi ?? 1 }}</h3>
                </div>
            </div>

            <div class="bg-[#588133] p-6 rounded-[30px] shadow-lg shadow-[#588133]/20 text-white flex flex-col justify-center">
                <p class="text-[10px] font-black uppercase tracking-widest opacity-80 mb-2">Urgensi Kerusakan</p>
                <div class="flex justify-between text-sm font-bold">
                    <span>Berat: {{ $kerusakanBerat ?? 1 }}</span>
                    <span class="opacity-40">|</span>
                    <span>Sedang: {{ $kerusakanSedang ?? 0 }}</span>
                    <span class="opacity-40">|</span>
                    <span>Ringan: {{ $kerusakanRingan ?? 0 }}</span>
                </div>
            </div>
        </div>
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