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

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="bg-gradient-to-br from-[#588133] to-[#99AF69] rounded-3xl p-6 text-white shadow-lg mb-8">
            <h3 class="text-xl font-bold">Halo, {{ Auth::user()->name }}! </h3>
            <p class="opacity-90 text-sm">Dashboard Real-time</p>
            
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                    <p class="text-xs uppercase font-bold opacity-80">Barang Tersedia</p>
                    <p class="text-2xl font-black">108</p>
                </div>
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                    <p class="text-xs uppercase font-bold opacity-80">Sedang Dipinjam</p>
                    <p class="text-2xl font-black">12</p>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" placeholder="Cari barang inventaris (misal: Kamera, Drone...)" class="block w-full pl-10 pr-3 py-4 border-none shadow-sm rounded-2xl focus:ring-2 focus:ring-[#588133] text-sm">
            </div>
        </div>

        <h4 class="font-bold text-gray-800 mb-4 flex justify-between items-center">
            Katalog Inventaris
            <span class="text-xs text-[#588133] bg-[#f1f5e9] px-3 py-1 rounded-full">Tersedia</span>
        </h4>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pb-20">
            @for ($i = 1; $i <= 6; $i++)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 group">
                <div class="h-40 bg-gray-100 flex items-center justify-center relative">
                    <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                    <span class="absolute top-3 right-3 bg-green-100 text-green-700 text-[10px] font-bold px-2 py-1 rounded-lg">READY</span>
                </div>
                <div class="p-5">
                    <h5 class="font-bold text-gray-800">Nama Barang Ke-{{ $i }}</h5>
                    <p class="text-xs text-gray-500 mt-1">Kategori: Alat Multimedia</p>
                    <button class="mt-4 w-full bg-[#588133] text-white py-2 rounded-xl text-sm font-bold hover:bg-[#466629] transition">Detail Pinjam</button>
                </div>
            </div>
            @endfor
        </div>
    </div>
</x-app-layout>