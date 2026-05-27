<x-app-layout>
    @include('layouts.sidebar')

    <x-slot name="header">
        {{-- Header sebagai Flex Container dengan inisialisasi Alpine.js untuk dropdown --}}
        <div x-data="{ showFilter: false }" class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-4 w-full">
            
            {{-- KIRI: Judul Halaman --}}
            <h2 class="font-semibold text-xl text-[#588133] leading-tight shrink-0">
                {{ __('Riwayat Peminjaman') }}
            </h2>

            {{-- KANAN: Form Search, Filter, & Tombol Buat Baru --}}
            <div class="flex flex-col sm:flex-row items-center gap-2 w-full md:w-auto relative">
                
                {{-- Form Search --}}
                <form method="GET" action="{{ route('pengguna.peminjaman.index') }}" class="flex w-full sm:w-auto gap-2 m-0">
                    
                    {{-- Input Search --}}
                    <div class="relative w-full sm:w-56 lg:w-64">
                        <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" placeholder="Cari aset..." value="{{ request('search') }}" 
                            class="w-full pl-9 pr-4 py-2 border border-[#e5edda] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#588133] focus:border-[#588133] text-sm shadow-sm transition-all"
                            onkeydown="if(event.key === 'Enter') { this.form.submit(); return false; }">
                        
                        {{-- Simpan state filter saat search --}}
                        @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                        @if(request('kategori')) <input type="hidden" name="kategori" value="{{ request('kategori') }}"> @endif
                    </div>
                </form>

                {{-- Tombol Filter --}}
                <button type="button" @click="showFilter = !showFilter" 
                        class="w-full sm:w-auto px-4 py-2 border border-[#e5edda] rounded-xl text-gray-600 font-medium text-sm flex items-center justify-center gap-2 hover:bg-gray-50 transition-colors shadow-sm bg-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>

                {{-- Tombol Buat Baru --}}
                <a href="{{ route('pengguna.peminjaman.create') }}" 
                   class="w-full sm:w-auto bg-[#588133] hover:bg-[#4a6d2b] text-white px-5 py-2 rounded-xl font-medium text-sm flex items-center justify-center gap-2 transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Baru
                </a>

                {{-- POP-OVER DROPDOWN FILTER --}}
                <div x-show="showFilter" 
                     @click.away="showFilter = false" 
                     x-transition.opacity.duration.200ms
                     style="display: none;" 
                     class="absolute top-12 right-0 w-full sm:w-[450px] bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-[#e5edda] p-6 z-50">
                    
                    <form method="GET" action="{{ route('pengguna.peminjaman.index') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        
                        <div>
                            <label class="text-sm font-semibold text-gray-600 mb-2 block">Status Peminjaman</label>
                            <div class="relative">
                                <select name="status" onchange="this.form.submit()" class="w-full px-4 py-2 border border-[#e5edda] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#588133] focus:border-[#588133] text-sm appearance-none cursor-pointer">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                <svg class="absolute right-3 top-2.5 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600 mb-2 block">Kategori Aset</label>
                            <div class="relative">
                                <select name="kategori" onchange="this.form.submit()" class="w-full px-4 py-2 border border-[#e5edda] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#588133] focus:border-[#588133] text-sm appearance-none cursor-pointer">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-3 top-2.5 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    {{-- KONTEN UTAMA HALAMAN --}}
    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        {{-- Notifikasi --}}
        @if (session('success') || session('status_berhasil'))
            <div class="mb-6 p-4 bg-[#f1f5e9] border border-[#588133] text-[#588133] rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-bold text-sm">{{ session('success') ?? session('status_berhasil') }}</span>
            </div>
        @endif

        {{-- Indikator Filter Aktif --}}
        @if(request()->has('search') || request()->has('status') || request()->has('kategori'))
        <div class="flex flex-wrap gap-2 mb-4">
            @if(request('search'))
                <span class="inline-flex items-center gap-2 bg-white border border-[#e5edda] text-gray-600 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                    🔍 {{ request('search') }}
                    <a href="{{ route('pengguna.peminjaman.index', array_merge(request()->query(), ['search' => null])) }}" class="hover:text-red-500">✕</a>
                </span>
            @endif
            @if(request('status'))
                <span class="inline-flex items-center gap-2 bg-white border border-[#e5edda] text-gray-600 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                    Status: {{ ucfirst(request('status')) }}
                    <a href="{{ route('pengguna.peminjaman.index', array_merge(request()->query(), ['status' => null])) }}" class="hover:text-red-500">✕</a>
                </span>
            @endif
            @if(request('kategori'))
                <span class="inline-flex items-center gap-2 bg-white border border-[#e5edda] text-gray-600 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                    Kategori: {{ $kategoris->find(request('kategori'))->nama_kategori ?? 'Kategori' }}
                    <a href="{{ route('pengguna.peminjaman.index', array_merge(request()->query(), ['kategori' => null])) }}" class="hover:text-red-500">✕</a>
                </span>
            @endif
            <a href="{{ route('pengguna.peminjaman.index') }}" class="text-[#588133] hover:underline text-xs font-semibold flex items-center ml-2">Reset</a>
        </div>
        @endif

        {{-- TABLE CONTAINER --}}
        <div class="bg-white rounded-[24px] shadow-sm border border-[#e5edda] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#6A8E45] text-white text-xs uppercase tracking-wider font-semibold">
                            <th class="px-6 py-4 rounded-tl-[24px]">ASET & KATEGORI</th>
                            <th class="px-6 py-4">TANGGAL PINJAM</th>
                            <th class="px-6 py-4">TANGGAL KEMBALI</th>
                            <th class="px-6 py-4">STATUS</th>
                            <th class="px-6 py-4 rounded-tr-[24px]">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($peminjamans as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                
                                <td class="px-6 py-5">
                                    <div class="font-bold text-gray-800 text-sm">{{ $item->aset->nama_aset ?? 'Aset Tidak Ditemukan' }}</div>
                                    <div class="text-[11px] text-gray-400 mt-1 italic">{{ $item->aset->kategori->nama_kategori ?? 'Kategori Tidak Ada' }}</div>
                                </td>
                                
                                <td class="px-6 py-5 text-sm text-gray-600 font-medium">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}
                                </td>
                                
                                <td class="px-6 py-5 text-sm text-gray-600 font-medium">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d M Y') }}
                                </td>
                                
                                <td class="px-6 py-5">
                                    @if($item->status_peminjaman == 'pending')
                                        <span class="px-3 py-1 bg-[#fff3cd] text-[#856404] rounded-full text-[10px] font-bold uppercase tracking-wider">Pending</span>
                                    @elseif($item->status_peminjaman == 'disetujui')
                                        <span class="px-3 py-1 bg-[#e8f5e9] text-[#2e7d32] rounded-full text-[10px] font-bold uppercase tracking-wider">Disetujui</span>
                                    @elseif($item->status_peminjaman == 'ditolak')
                                        <span class="px-3 py-1 bg-[#ffebee] text-[#c62828] rounded-full text-[10px] font-bold uppercase tracking-wider">Ditolak</span>
                                    @else
                                        <span class="px-3 py-1 bg-[#e2e8f0] text-[#475569] rounded-full text-[10px] font-bold uppercase tracking-wider">{{ $item->status_peminjaman }}</span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-5">
                                    <a href="{{ route('pengguna.peminjaman.show', $item->id) }}" class="text-gray-400 hover:text-[#588133] italic text-xs font-medium transition-colors">Lihat Detail</a>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic text-sm">
                                    Belum ada riwayat peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('status_berhasil') || session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('status_berhasil') ?? session('success') }}",
                confirmButtonColor: '#588133',
                customClass: {
                    popup: 'rounded-[24px]',
                    confirmButton: 'rounded-full px-6 py-2'
                }
            });
        });
    </script>
    @endif
</x-app-layout>