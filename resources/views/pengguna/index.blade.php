<x-app-layout>
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
            <button class="bg-[#588133] text-white px-4 py-2 rounded-full text-xs font-bold whitespace-nowrap">Semua</button>
            <button class="bg-white text-gray-600 px-4 py-2 rounded-full text-xs font-bold border border-gray-200 whitespace-nowrap">Kamera</button>
            <button class="bg-white text-gray-600 px-4 py-2 rounded-full text-xs font-bold border border-gray-200 whitespace-nowrap">Audio</button>
            <button class="bg-white text-gray-600 px-4 py-2 rounded-full text-xs font-bold border border-gray-200 whitespace-nowrap">Lighting</button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pb-24">
            @for ($i = 1; $i <= 8; $i++)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                <div class="aspect-square bg-gray-100 flex items-center justify-center relative">
                    <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                    </svg>
                    <span class="absolute top-2 right-2 bg-[#f1f5e9] text-[#588133] text-[10px] font-black px-2 py-1 rounded-lg">TERSEDIA</span>
                </div>

                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-bold text-gray-800 text-sm line-clamp-2">Kamera Mirrorless Sony A6400 (Body Only)</h3>
                    <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest font-bold">Stok: 5 unit</p>
                    
                    <button class="mt-4 w-full bg-[#f1f5e9] text-[#588133] py-2 rounded-xl text-xs font-bold hover:bg-[#588133] hover:text-white transition-all duration-300">
                        Pilih Barang
                    </button>
                </div>
            </div>
            @endfor
        </div>
    </div>
</x-app-layout>