<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-[#588133] leading-tight">
                {{ __('Manajemen Stok Inventaris') }}
            </h2>
            <a href="{{ route('inventaris.create') }}" class="bg-[#588133] text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-[#466629] transition duration-150 shadow-sm">
                + Tambah Barang
            </a>
        </div>
    </x-slot>

    <div>
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
            <h3 class="text-xl font-bold">Manajemen Dashboard Real-time</h3>
            
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                    <p class="text-xs uppercase font-bold opacity-80">Barang Tersedia</p>
                 <input type="number" name="barang_tersedia" 
                           value="{{ $stats->barang_tersedia ?? 0 }}" 
                           class="bg-transparent text-3xl font-bold opacity-80 w-full focus:outline-none border-b-2 border-white/30 focus:border-white">
                    
                </div>
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                    <p class="text-xs uppercase font-bold opacity-80">Sedang Dipinjam</p>
                    <input type="number" name="barang_tersedia" 
                           value="{{ $stats->barang_tersedia ?? 0 }}" 
                           class="bg-transparent text-3xl font-bold opacity-80 w-full focus:outline-none border-b-2 border-white/30 focus:border-white">
                </div>
            </div>
             <button type="submit" class="mt-6 bg-[#99AF69] hover:bg-[#588133] text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md">
                Update Dashboard Pengguna
            </button>
        </div>
    </div>

    <div class=" px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="mb-6 relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" placeholder="Cari kode atau nama barang..." 
                class="w-full pl-10 pr-4 py-3 border-none shadow-sm rounded-2xl focus:ring-2 focus:ring-[#588133] bg-white">
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#f1f5e9] text-[#588133] border-b border-gray-100">
                        <tr>
                            <th class="p-4 font-bold w-20">Foto</th>
                            <th class="p-4 font-bold">Kode</th>
                            <th class="p-4 font-bold">Nama Barang</th>
                            <th class="p-4 font-bold text-center">Stok</th>
                            <th class="p-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="p-4">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-500 font-medium">CAM-001</td>
                            <td class="p-4 font-medium text-gray-800">Kamera Sony A6400</td>
                            <td class="p-4 text-center">
                                <span class="bg-[#f1f5e9] text-[#588133] px-3 py-1 rounded-full text-sm font-bold">5</span>
                            </td>
                            <td class="p-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('inventaris.edit') }}" class="bg-yellow-400 text-white p-2 rounded-lg hover:bg-yellow-500 shadow-sm transition duration-150 inline-block" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 shadow-sm transition duration-150" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>