<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#588133] leading-tight">
                {{ __('Manajemen Stok Inventaris (Admin)') }}
            </h2>
            <a href="#" class="bg-[#588133] text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-[#466629]">
                + Tambah Barang
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="mb-6">
            <input type="text" placeholder="Cari kode atau nama barang..." class="w-full border-none shadow-sm rounded-2xl focus:ring-2 focus:ring-[#588133]">
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#f1f5e9] text-[#588133]">
                        <tr>
                            <th class="p-4 font-bold">Foto</th>
                            <th class="p-4 font-bold">Nama Barang</th>
                            <th class="p-4 font-bold text-center">Stok</th>
                            <th class="p-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="p-4">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                </div>
                            </td>
                            <td class="p-4 font-medium text-gray-800">Kamera Sony A6400</td>
                            <td class="p-4 text-center">
                                <span class="bg-[#f1f5e9] text-[#588133] px-3 py-1 rounded-full font-bold">5</span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button class="bg-yellow-400 text-white p-2 rounded-lg hover:bg-yellow-500 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 shadow-sm">
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