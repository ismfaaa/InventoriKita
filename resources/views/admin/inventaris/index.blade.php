<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-[#588133] leading-tight">
                {{ __('Manajemen Inventaris & Kategori') }}
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('kategori.create') }}" class="bg-white text-[#588133] border border-[#588133] px-4 py-2 rounded-xl text-sm font-bold hover:bg-[#f1f5e9] transition shadow-sm">
                    + Kategori
                </a>
                <a href="{{ route('inventaris.create') }}" class="bg-[#588133] text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-[#466629] transition shadow-sm">
                    + Tambah Barang
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-12">
        
        @if (session('status'))
            <div class="p-4 bg-green-50 text-[#588133] border border-green-200 rounded-2xl font-medium text-sm">
                {{ session('status') }}
            </div>
        @endif

        <section>
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-lg text-gray-800">Daftar Kategori</h3>
                <p class="text-xs text-gray-400">Total: {{ $kategoris->count() }} kategori</p>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#f1f5e9] text-[#588133]">
                        <tr>
                            <th class="p-4 font-bold w-20 text-center">No</th>
                            <th class="p-4 font-bold">Nama Kategori</th>
                            <th class="p-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($kategoris as $key => $kategori)
                        {{-- Alphine js => [editing:    false] --}}
                            <tr x-data="{ editing: false }" class="hover:bg-gray-50 transition">
                            <td class="p-4 text-center text-gray-500 text-sm">{{ $key + 1 }}</td>
                            
                            <td class="p-4 font-medium text-gray-800">
                                <span x-show="!editing">{{ $kategori->nama_kategori }}</span>

                                <form x-show="editing" action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="flex gap-2 items-center" style="display: none;">
                                    @csrf 
                                    @method('PUT')
                                    <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" 
                                        class="border-gray-300 rounded-lg text-sm px-3 py-1 w-full focus:ring-[#588133] focus:border-[#588133]" required>
                                    
                                    <button type="submit" class="bg-green-500 text-white p-1.5 rounded-lg hover:bg-green-600 transition shadow-sm" title="Simpan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
            
                                    <button type="button" @click="editing = false" class="bg-gray-400 text-white p-1.5 rounded-lg hover:bg-gray-500 transition shadow-sm" title="Batal">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>
                            </td>

                            <td class="p-4">
                                <div class="flex justify-center gap-2">
                                    <button type="button" @click="editing = true" class="text-yellow-500 p-2 hover:bg-yellow-50 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    
                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 p-2 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="3" class="p-8 text-center text-gray-400">Belum ada kategori.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-lg text-gray-800">Daftar Barang Inventaris</h3>
                <div class="relative w-64">
                    <form action="{{ route('inventaris.index') }}" method="GET">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." class="w-full pl-9 pr-4 py-2 text-xs border-gray-200 rounded-xl focus:ring-[#588133] focus:border-[#588133]" onkeypress="if(event.key === 'Enter') this.form.submit()">
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#f1f5e9] text-[#588133]">
                        <tr>
                            <th class="p-4 font-bold w-20">Foto</th>
                            <th class="p-4 font-bold">Kode</th>
                            <th class="p-4 font-bold">Nama Barang</th>
                            <th class="p-4 font-bold text-center">Stok</th>
                            <th class="p-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($asets as $aset)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-300">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                    </div>
                                </td>
                                <td class="p-4 text-sm font-medium text-gray-500">{{ $aset->kode_aset }}</td>
                                <td class="p-4 font-medium text-gray-800">{{ $aset->nama_aset }}</td>
                                <td class="p-4 text-center">
                                    <span class="bg-[#f1f5e9] text-[#588133] px-3 py-1 rounded-full text-xs font-bold">{{ $aset->kuantitas }}</span>
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('inventaris.edit', $aset->id) }}" class="text-yellow-500 p-2 hover:bg-yellow-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                                        <button class="text-red-500 p-2 hover:bg-red-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-8 text-center text-gray-400">Belum ada barang inventaris.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-app-layout>