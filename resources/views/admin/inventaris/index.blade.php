<x-app-layout>

    @include('layouts.sidebar')

    {{-- ================= HEADER: JUDUL & ALAT ================= --}}
    <x-slot name="header">
        <div class="px-2 sm:px-6n lg:px-8 max-w-full mx-auto flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            
            <h3 class="font-bold text-2xl text-[#588133] leading-tight shrink-0">
                {{ __('Manajemen Inventaris') }}
            </h3>
            
            <div class="flex flex-wrap items-center gap-3">
                
                {{-- 1. FITUR PENCARIAN --}}
                <div class="relative w-full sm:w-56 lg:w-64 h-[42px]">
                    <form action="{{ route('inventaris.index') }}" method="GET" class="h-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aset..." 
                            class="w-full h-full pl-9 pr-4 text-xs border border-gray-200 rounded-xl focus:ring-[#588133] focus:border-[#588133] bg-[#f1f5e9] shadow-sm transition-all" 
                            onkeydown="if(event.key === 'Enter') { this.form.submit(); return false; }">
                        
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                    </form>
                </div>

                {{-- 2. FITUR FILTER --}}
                <div class="relative h-[42px]" x-data="{ open: false }">
                    <button @click="open = !open" type="button" 
                        class="group h-full flex items-center gap-2 px-4 rounded-xl text-xs font-bold transition shadow-sm
                        {{ request('category') ? 'bg-[#588133] text-white border border-[#588133] hover:bg-[#466629]' : 'bg-[#f1f5e9] text-gray-600 border border-gray-200 hover:bg-[#466629] hover:text-white' }}">
                        
                        <svg class="w-4 h-4 shrink-0 transition-colors {{ request('category') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>                        
                        <span class="hidden sm:inline">Filter Kategori</span>                
                        @if(request('category'))
                            <span class="flex h-2 w-2 relative ml-1">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                            </span>
                        @endif
                    </button>

                    <div x-show="open" @click.away="open = false" 
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 overflow-hidden"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-cloak>
                        
                        <a href="{{ route('inventaris.index', ['search' => request('search')]) }}" class="block px-4 py-3 text-xs font-medium text-gray-700 hover:bg-[#466629] hover:text-white transition">
                            Semua Kategori
                        </a>
                        <hr class="border-gray-50">
                        @foreach ($kategoris as $kategori)
                            <a href="{{ route('inventaris.index', ['category' => $kategori->id, 'search' => request('search')]) }}" 
                                class="block px-4 py-3 text-xs {{ request('category') == $kategori->id ? 'bg-[#f1f5e9] text-[#588133] font-bold' : 'font-medium text-gray-700' }} hover:bg-[#466629] hover:text-white transition">
                                {{ $kategori->nama_kategori }}
                            </a>
                        @endforeach
                    </div>
                </div>
                {{-- 3. TOMBOL TAMBAH BARU --}}
                <div class="relative h-[42px]" x-data="{ open: false }">
                    <button @click="open = !open" type="button" 
                        class="h-full flex items-center gap-2 bg-[#588133] border border-[#588133] text-white px-4 rounded-xl text-sm font-bold hover:bg-[#466629] transition shadow-sm">
                        <span>+ Tambah Baru</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="open" @click.away="open = false" 
                        class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 overflow-hidden"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95 translate-y-[-10px]"
                        x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                        x-cloak>
                        
                        <a href="{{ route('kategori.create') }}" class="flex items-center gap-2 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-[#f1f5e9] hover:text-[#588133] transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            Kategori
                        </a>
                        <hr class="border-gray-50">
                        <a href="{{ route('inventaris.create') }}" class="flex items-center gap-2 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-[#f1f5e9] hover:text-[#588133] transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            Aset Inventaris
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </x-slot>

    {{-- ================= KONTEN UTAMA ================= --}}
    {{-- Ditambahkan items-start agar kartu tidak melar ke bawah secara otomatis --}}
    <div class="py-8 px-2 sm:px-6 lg:px-8 max-w-full mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        @if (session('status'))
            <div class="lg:col-span-12 p-4 bg-green-50 text-[#588133] border border-green-200 rounded-2xl font-medium text-sm flex items-center gap-2" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('status') }}
            </div>
        @endif

        {{-- CARD KIRI: TABEL KATEGORI --}}
        {{-- Diberi max-h agar menyesuaikan isi, tapi tetap scrollable jika data banyak --}}
        <section class="lg:col-span-3 bg-white shadow-sm sm:rounded-3xl border border-gray-100 flex flex-col max-h-[calc(100vh-12rem)] overflow-hidden">
            <div class="flex-1 overflow-y-auto table-scroll relative">
                <table class="w-full text-left border-collapse">
                    <thead class="text-white sticky top-0 z-10 shadow-sm">
                        <tr>
                            <th class="bg-[#729c4b] p-4 font-bold w-16 text-center text-sm">No</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-sm">Kategori</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-center w-28 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($kategoris as $key => $kategori)
                            <tr x-data="{ editing: false }" class="hover:bg-gray-50 transition group">
                                <td class="p-4 text-center text-gray-500 text-sm">{{ $key + 1 }}</td>
                                <td class="p-4 font-medium text-gray-800 text-sm">
                                    <span x-show="!editing">{{ $kategori->nama_kategori }}</span>
                                    @include('admin.kategori.edit')
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-center gap-2">
                                        <button type="button" @click="editing = true" class="text-yellow-500 hover:bg-yellow-50 p-2 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        @include('admin.kategori.delete')
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="p-8 text-center text-gray-400 text-sm">Belum ada kategori.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- CARD KANAN: TABEL ASET --}}
        <section class="lg:col-span-9 bg-white shadow-sm sm:rounded-3xl border border-gray-100 flex flex-col max-h-[calc(100vh-12rem)] overflow-hidden">
            <div class="flex-1 overflow-y-auto table-scroll relative">
                <table class="w-full text-left border-collapse">
                    <thead class="text-white sticky top-0 z-10 shadow-sm">
                        <tr>
                            <th class="bg-[#729c4b] p-4 font-bold w-16 text-center text-sm">Foto</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-sm">Kode</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-sm">Nama Aset</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-sm">Kategori</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-center text-sm">Lokasi</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-center w-28 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($asets as $aset)
                            <tr x-data="{ showEditModal: false }" class="hover:bg-gray-50 transition group">
                                <td class="p-4">
                                    <div class="flex justify-center">
                                        @if($aset->foto)
                                            <img src="{{ asset('storage/' . $aset->foto) }}" alt="Foto" class="w-10 h-10 rounded-lg object-cover border border-gray-200 shadow-sm transform group-hover:scale-110 transition duration-300">
                                        @else
                                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-300 shadow-sm">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-gray-500 font-mono">{{ $aset->kode_aset }}</td>
                                <td class="p-4 text-sm font-medium text-gray-800">{{ $aset->nama_aset }}</td>
                                <td class="p-4 text-sm text-gray-500">{{ $aset->kategori->nama_kategori }}</td>
                                <td class="p-4 text-center">
                                    <span class="bg-[#f1f5e9] text-[#588133] px-3 py-1.5 rounded-full text-[11px] font-bold border border-[#d6e4c7] inline-block">{{ $aset->lokasi }}</span>
                                </td>
                                <td class="p-4">                        
                                    <div class="flex justify-center gap-2">
                                        <button type="button" @click="showEditModal = true" class="text-yellow-500 hover:bg-yellow-50 p-2 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        <form action="{{ route('inventaris.destroy', $aset->id) }}" method="POST" class="inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                    @include('admin.inventaris.edit', ['aset' => $aset, 'kategoris' => $kategoris])
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="p-12 text-center text-gray-400 text-sm">Belum ada aset inventaris.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Bagian Pagination --}}
            <div class="p-4 border-t border-gray-100 bg-white z-20 shrink-0">
                <div class="pagination-matcha">
                    {{ $asets->appends(request()->query())->links() }}
                </div>
            </div>
        </section>

    </div>

    <style>
        [x-cloak] { display: none !important; }
        
        .pagination-matcha nav a, 
        .pagination-matcha nav span[aria-disabled="true"] span {
            background-color: white !important; 
            color: #588133 !important; 
            border-radius: 10px;
            border-color: #f3f4f6 !important; 
        }

        .pagination-matcha nav a:hover {
            background-color: #f1f5e9 !important;
        }

        .pagination-matcha nav span[aria-current="page"] span {
            background-color: #588133 !important;
            border-color: #588133 !important;
            color: white !important;
            border-radius: 10px;
        }

        .table-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
        .table-scroll::-webkit-scrollbar-track { background: transparent; }
        .table-scroll::-webkit-scrollbar-thumb { background-color: #e2e8f0; border-radius: 8px; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background-color: #cbd5e1; }
    </style>

    <!-- SWEETALERT  -->
 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // UNTUK POP-UP BERHASIL
            @if (session('success') || session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{!! session('success') ?? session('status') !!}',
                    showConfirmButton: false,
                });
            @endif

            // UNTUK POP-UP KONFIRMASI HAPUS
            const formHapus = document.querySelectorAll('.form-hapus');
            
            formHapus.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); 
                    
                    Swal.fire({
                        title: "Yakin ingin menghapus?",
                        text: "Tindakan ini akan menghapus selamanya!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#ef4444",
                        cancelButtonColor: "#9ca3af",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Tidak, kembali!",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); 
                        } 
                    });
                });
            });
        });
    </script>
    
</x-app-layout>