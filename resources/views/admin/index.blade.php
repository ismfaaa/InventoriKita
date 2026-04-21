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

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
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