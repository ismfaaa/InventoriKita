<x-app-layout>
    @include('layouts.sidebar')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Manajemen Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" x-data="{ openModal: false, selectedId: null, showFilter: false }">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Daftar Aktivitas Aset</h3>
                <p class="text-sm text-gray-500">Kelola persetujuan dan pantau status peminjaman secara real-time.</p>
            </div>
            <div class="flex gap-2">
                <span class="bg-[#f1f5e9] text-[#588133] px-4 py-2 rounded-2xl text-xs font-bold border border-[#e5edda]">
                    Total Pengajuan: {{ $peminjamans->total() ?? 0 }}
                </span>
            </div>
        </div>

        <!-- SEARCH & FILTER SECTION -->
        <div class="mb-6 bg-white rounded-[30px] border border-[#e5edda] p-6 shadow-sm">
            <div class="flex flex-col gap-4">
                <!-- SEARCH BAR -->
                <form method="GET" action="{{ route('manajemen.peminjaman.index') }}" class="flex gap-2">
                    <div class="flex-1 relative">
                        <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" placeholder="Cari peminjam atau aset..." value="{{ request('search') }}" class="w-full pl-12 pr-4 py-2.5 border border-[#e5edda] rounded-[20px] focus:outline-none focus:ring-2 focus:ring-[#588133] text-sm">
                    </div>
                    <button type="submit" class="bg-[#588133] hover:bg-[#466629] text-white px-6 py-2.5 rounded-[20px] font-bold text-sm transition-all">
                        Cari
                    </button>
                    <button type="button" @click="showFilter = !showFilter" class="border border-[#588133] text-[#588133] hover:bg-[#f1f5e9] px-6 py-2.5 rounded-[20px] font-bold text-sm transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Filter
                    </button>
                </form>

                <!-- FILTER OPTIONS -->
                <div x-show="showFilter" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-[#e5edda]">
                    <div>
                        <label class="text-sm font-bold text-gray-700 mb-2 block">Status Peminjaman</label>
                        <form method="GET" action="{{ route('manajemen.peminjaman.index') }}" class="flex gap-2 flex-wrap">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                            
                            <select name="status" onchange="this.form.submit()" class="w-full px-4 py-2 border border-[#e5edda] rounded-[15px] focus:outline-none focus:ring-2 focus:ring-[#588133] text-sm appearance-none bg-white cursor-pointer bg-no-repeat bg-right pr-10" style="background-image: url('data:image/svg+xml;utf8,<svg fill=\"%23588133\" height=\"24\" viewBox=\"0 0 24 24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M7 10l5 5 5-5z\"/></svg>'); background-position: right 0.5rem center; background-size: 1.5em 1.5em;">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </div>

                    <div>
                        <label class="text-sm font-bold text-gray-700 mb-2 block">Kategori Aset</label>
                        <form method="GET" action="{{ route('manajemen.peminjaman.index') }}" class="flex gap-2 flex-wrap">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="status" value="{{ request('status') }}">
                            
                            <select name="kategori" onchange="this.form.submit()" class="w-full px-4 py-2 border border-[#e5edda] rounded-[15px] focus:outline-none focus:ring-2 focus:ring-[#588133] text-sm appearance-none bg-white cursor-pointer bg-no-repeat bg-right pr-10" style="background-image: url('data:image/svg+xml;utf8,<svg fill=\"%23588133\" height=\"24\" viewBox=\"0 0 24 24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M7 10l5 5 5-5z\"/></svg>'); background-position: right 0.5rem center; background-size: 1.5em 1.5em;">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori ?? $kategori->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                <!-- ACTIVE FILTERS DISPLAY -->
                @if(request()->has('search') || request()->has('status') || request()->has('kategori'))
                <div class="flex flex-wrap gap-2 pt-2">
                    @if(request('search'))
                        <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-full text-xs font-bold">
                            🔍 {{ request('search') }}
                            <a href="{{ route('manajemen.peminjaman.index', array_merge(request()->query(), ['search' => null])) }}" class="hover:opacity-70">✕</a>
                        </span>
                    @endif
                    @if(request('status'))
                        <span class="inline-flex items-center gap-2 bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-full text-xs font-bold">
                            Status: {{ ucfirst(request('status')) }}
                            <a href="{{ route('manajemen.peminjaman.index', array_merge(request()->query(), ['status' => null])) }}" class="hover:opacity-70">✕</a>
                        </span>
                    @endif
                    @if(request('kategori'))
                        <span class="inline-flex items-center gap-2 bg-purple-50 text-purple-600 px-3 py-1.5 rounded-full text-xs font-bold">
                            Kategori: {{ $kategoris->find(request('kategori'))->nama_kategori ?? $kategoris->find(request('kategori'))->name }}
                            <a href="{{ route('manajemen.peminjaman.index', array_merge(request()->query(), ['kategori' => null])) }}" class="hover:opacity-70">✕</a>
                        </span>
                    @endif
                    <a href="{{ route('manajemen.peminjaman.index') }}" class="text-gray-500 hover:text-gray-700 text-xs font-bold">Reset Semua</a>
                </div>
                @endif
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-[30px] border border-[#e5edda]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#f8faf2] text-[#588133] text-[11px] uppercase tracking-widest">
                            <th class="p-5 font-black">Peminjam</th>
                            <th class="p-5 font-black">Aset / Barang</th>
                            {{-- HEADER DIPISAH JADI 2 --}}
                            <th class="p-5 font-black text-center">Tanggal Peminjaman</th>
                            <th class="p-5 font-black text-center">Tanggal Pengembalian</th>
                            <th class="p-5 font-black text-center">Status</th>
                            <th class="p-5 font-black text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($peminjamans as $item)
                        <tr class="hover:bg-[#fcfdfa] transition-colors">
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#99AF69] flex items-center justify-center text-white text-xs font-bold">
                                        {{ substr($item->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-gray-700">{{ $item->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="p-5 text-sm text-gray-600">
                                <span class="font-semibold block">{{ $item->aset->nama_aset ?? 'Aset Tidak Ditemukan' }}</span>
                                <span class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $item->aset->lokasi ?? '-' }}</span>
                            </td>
                            
                            {{-- KOLOM 1: TANGGAL PEMINJAMAN --}}
                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-lg">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</span>
                                </div>
                            </td>

                            {{-- KOLOM 2: TANGGAL PENGEMBALIAN --}}
                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-orange-50 rounded-lg">
                                    <svg class="w-3 h-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</span>
                                </div>
                            </td>

                            <td class="p-5 text-center">
                                @if($item->status_peminjaman == 'pending')
                                    <span class="bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Menunggu</span>
                                @elseif($item->status_peminjaman == 'disetujui')
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Dipinjam</span>
                                @elseif($item->status_peminjaman == 'ditolak')
                                    <div class="flex flex-col items-center">
                                        <span class="bg-red-50 text-red-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Ditolak</span>
                                    </div>
                                @else
                                    <span class="bg-[#f1f5e9] text-[#588133] px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Selesai</span>
                                @endif
                            </td>
                            <td class="p-5">
                                <div class="flex justify-center gap-2">
                                    @if($item->status_peminjaman == 'pending')
                                    <!-- TOMBOL SETUJUI -->
                                    <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit" class="bg-[#588133] hover:bg-[#466629] text-white p-2.5 rounded-xl transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                    </form>

                                    <!-- TOMBOL TOLAK -->
                                        <button @click="openModal = true; selectedId = {{ $item->id }}" class="bg-white border border-red-200 text-red-500 hover:bg-red-50 p-2.5 rounded-xl transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>

                                    @elseif($item->status_peminjaman == 'disetujui')
                                    <!-- TOMBOL SELESAIKAN -->
                                    <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="bg-[#588133] text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase">
                                            Selesaikan
                                        </button>
                                    </form>
                                    
                                    @else
                                        <span class="text-gray-300 text-[10px] font-medium uppercase italic">Archived</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-20 text-center">
                                <p class="text-gray-400 italic text-sm">Belum ada riwayat pengajuan peminjaman.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PAGINATION -->
        @if($peminjamans->hasPages())
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center gap-2">
                {{-- Previous Button --}}
                @if($peminjamans->onFirstPage())
                    <span class="px-4 py-2.5 bg-gray-100 text-gray-400 rounded-[15px] text-sm font-bold cursor-not-allowed">← Sebelumnya</span>
                @else
                    <a href="{{ $peminjamans->previousPageUrl() }}" class="px-4 py-2.5 bg-[#588133] hover:bg-[#466629] text-white rounded-[15px] text-sm font-bold transition-all">← Sebelumnya</a>
                @endif

                {{-- Page Numbers --}}
                <div class="flex gap-1">
                    @foreach($peminjamans->getUrlRange(1, $peminjamans->lastPage()) as $page => $url)
                        @if($page == $peminjamans->currentPage())
                            <span class="px-3.5 py-2.5 bg-[#588133] text-white rounded-[15px] text-sm font-bold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3.5 py-2.5 bg-gray-100 hover:bg-[#f1f5e9] text-[#588133] rounded-[15px] text-sm font-bold transition-all">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                {{-- Next Button --}}
                @if($peminjamans->hasMorePages())
                    <a href="{{ $peminjamans->nextPageUrl() }}" class="px-4 py-2.5 bg-[#588133] hover:bg-[#466629] text-white rounded-[15px] text-sm font-bold transition-all">Selanjutnya →</a>
                @else
                    <span class="px-4 py-2.5 bg-gray-100 text-gray-400 rounded-[15px] text-sm font-bold cursor-not-allowed">Selanjutnya →</span>
                @endif
            </nav>
        </div>

        <div class="mt-4 text-center text-sm text-gray-500">
            Menampilkan {{ $peminjamans->firstItem() ?? 0 }} - {{ $peminjamans->lastItem() ?? 0 }} dari {{ $peminjamans->total() }} data
        </div>
        @endif

        {{-- Modal Tetap Sama --}}
        <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" x-cloak x-transition>
            <div @click.away="openModal = false" class="bg-white rounded-[40px] max-w-md w-full p-8 shadow-2xl">
                <h3 class="text-xl font-black text-gray-800 mb-6">Alasan Penolakan</h3>
                <textarea class="w-full border-none bg-[#f1f5e9] rounded-[25px] p-5 h-40 text-sm" placeholder="Tulis alasan..."></textarea>
                <div class="flex gap-4 mt-8">
                    <button @click="openModal = false" class="flex-1 py-4 text-gray-500 font-bold text-sm">Batal</button>
                    <button class="flex-1 py-4 bg-red-500 text-white font-bold rounded-[20px] text-sm">Kirim</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>