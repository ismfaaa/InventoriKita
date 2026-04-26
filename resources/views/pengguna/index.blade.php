<x-app-layout>
    <div x-data="{ showSidebar: false }" @open-sidebar.window="showSidebar = true">
        <div x-show="showSidebar" class="fixed inset-0 z-50 flex" role="dialog">
            <div x-show="showSidebar" @click="showSidebar = false" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white shadow-xl">
                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="text-lg font-bold text-[#588133]">Menu Utama</h2>
                    <button @click="showSidebar = false" class="text-gray-500 text-2xl">&times;</button>
                </div>
                <div class="flex-1 overflow-y-auto p-4 space-y-2">
                    <a href="#" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">Form Peminjaman Baru</a>
                    <a href="#" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">Form Pengembalian Alat</a>
                    <a href="#" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">Lapor Kerusakan Alat</a>
                </div>
            </div>
        </div>
    </div>

    @php
    $stats = \DB::table('dashboard_stats')->where('id', 1)->first();
    @endphp

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="bg-gradient-to-br from-[#588133] to-[#99AF69] rounded-3xl p-6 text-white shadow-lg mb-8">
            <h3 class="text-xl font-bold">Halo, {{ Auth::user()->name }}! </h3>
            <p class="opacity-90 text-sm">Dashboard Real-time</p>
            
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                    <p class="text-xs uppercase font-bold opacity-80">Barang Tersedia</p>
                    <p class="text-2xl font-black">{{ $stats->barang_tersedia ?? 0 }}</p>
                </div>
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                    <p class="text-xs uppercase font-bold opacity-80">Sedang Dipinjam</p>
                    <p class="text-2xl font-black">{{ $stats->sedang_dipinjam ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white border-b border-[#e5edda]">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-bold text-2xl text-[#588133] leading-tight">
                Katalog Inventaris
            </h2>
            <p class="text-sm text-gray-500 mt-1">Pilih barang yang ingin Anda pinjam hari ini.</p>
            
            <div class="mt-6 relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" placeholder="Cari alat multimedia, kabel, dll..." 
                    class="block w-full pl-10 pr-4 py-3 border-none bg-[#f1f5e9] rounded-2xl focus:ring-2 focus:ring-[#588133] text-sm">
            </div>
        </div>
    </div>

    
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="flex gap-2 overflow-x-auto pb-4 mb-4 no-scrollbar">
        @foreach ($kategoris as $kategori)
            <button class="bg-white text-gray-600 border border-gray-200 px-4 py-2 rounded-full text-xs font-bold whitespace-nowrap hover:bg-[#588133] hover:text-white hover:border-[#588133] transition-colors duration-300">
                {{ $kategori->nama_kategori }}
            </button>
        @endforeach     
        </div>
    

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pb-24">
            @foreach ($asets as $aset)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                <div class="aspect-square overflow-hidden bg-gray-100 flex items-center justify-center relative">
                    @if ($aset->foto)
                        <img src="{{ Storage::url($aset->foto) }}" alt="{{ $aset->nama_aset }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                        </svg>
                    @endif
                    <span class="absolute top-2 right-2 bg-[#f1f5e9] text-[#588133] text-[10px] font-black px-2 py-1 rounded-lg">TERSEDIA</span>
                </div>

                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-bold text-gray-800 text-sm line-clamp-2">{{ $aset->nama_aset }}</h3>
                    <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest font-bold">{{ $aset->lokasi }}</p>
                    
                    <button class="mt-4 w-full bg-[#f1f5e9] text-[#588133] py-2 rounded-xl text-xs font-bold hover:bg-[#588133] hover:text-white transition-all duration-300">
                        Detail Barang
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
</x-app-layout>