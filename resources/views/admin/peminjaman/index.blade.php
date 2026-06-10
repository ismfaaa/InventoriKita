<x-app-layout>
    @include('layouts.sidebar')
    
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-[#588133] leading-tight">
                {{ __('Manajemen Peminjaman') }}
            </h2>
            
            <div x-data="{ showFilter: false }" class="relative z-10">
                <form method="GET" action="{{ route('manajemen.peminjaman.index') }}" class="flex items-center gap-3">
                    <div class="relative w-64">
                        <svg class="absolute left-4 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" placeholder="Cari aset atau peminjam..." value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-[#588133] text-sm">
                    </div>
                    
                    <button type="button" @click="showFilter = !showFilter" class="border border-[#588133] text-[#588133] bg-white hover:bg-[#f1f5e9] px-5 py-2 rounded-full font-semibold text-sm transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Filter
                    </button>
                </form>

                <div x-show="showFilter" @click.away="showFilter = false" x-transition class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-xl border border-gray-100 p-5">
                    <div class="flex flex-col gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-700 mb-2 block uppercase tracking-wider">Status Peminjaman</label>
                            <form method="GET" action="{{ route('manajemen.peminjaman.index') }}">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                <select name="status" onchange="this.form.submit()" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#588133] text-sm bg-gray-50">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Dipinjam</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-700 mb-2 block uppercase tracking-wider">Kategori Aset</label>
                            <form method="GET" action="{{ route('manajemen.peminjaman.index') }}">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="status" value="{{ request('status') }}">
                                <select name="kategori" onchange="this.form.submit()" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#588133] text-sm bg-gray-50">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori ?? $kategori->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="pt-4 pb-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" x-data="{ openModal: false, selectedId: null }">
        
        @if(request()->has('search') || request()->has('status') || request()->has('kategori'))
        <div class="flex flex-wrap gap-2 mb-4">
            @if(request('search'))
                <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-full text-xs font-bold border border-blue-100">
                    🔍 {{ request('search') }}
                    <a href="{{ route('manajemen.peminjaman.index', array_merge(request()->query(), ['search' => null])) }}" class="hover:opacity-70">✕</a>
                </span>
            @endif
            @if(request('status'))
                <span class="inline-flex items-center gap-2 bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-full text-xs font-bold border border-yellow-100">
                    Status: {{ ucfirst(request('status')) }}
                    <a href="{{ route('manajemen.peminjaman.index', array_merge(request()->query(), ['status' => null])) }}" class="hover:opacity-70">✕</a>
                </span>
            @endif
            @if(request('kategori'))
                <span class="inline-flex items-center gap-2 bg-purple-50 text-purple-600 px-3 py-1.5 rounded-full text-xs font-bold border border-purple-100">
                    Kategori: {{ $kategoris->find(request('kategori'))->nama_kategori ?? $kategoris->find(request('kategori'))->name }}
                    <a href="{{ route('manajemen.peminjaman.index', array_merge(request()->query(), ['kategori' => null])) }}" class="hover:opacity-70">✕</a>
                </span>
            @endif
            <a href="{{ route('manajemen.peminjaman.index') }}" class="text-gray-400 hover:text-gray-600 text-xs font-bold flex items-center">Reset Semua</a>
        </div>
        @endif

        <div class="bg-white rounded-[30px] p-5 shadow-sm border border-gray-100">
            <div class="overflow-hidden rounded-2xl border border-[#e5edda]">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#588133] text-white">
                        <tr class="text-[11px] uppercase tracking-widest border-b-0">
                            <th class="p-5 font-black whitespace-nowrap rounded-tl-2xl">Peminjam</th>
                            <th class="p-5 font-black whitespace-nowrap">Aset / Barang</th>
                            <th class="p-5 font-black text-center whitespace-nowrap">Tgl Pinjam</th>
                            <th class="p-5 font-black text-center whitespace-nowrap">Tgl Kembali</th>
                            <th class="p-5 font-black text-center whitespace-nowrap">Status</th>
                            <th class="p-5 font-black text-center whitespace-nowrap rounded-tr-2xl">Tindakan</th>
                        </tr>
                    </thead>
                    
                    <tbody class="divide-y divide-gray-100">
                        @forelse($peminjamans as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#e8eedf] flex items-center justify-center text-[#588133] text-sm font-bold border border-[#c5d8a4]">
                                        {{ substr($item->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-gray-800">{{ $item->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            
                            <td class="p-5">
                                <span class="text-sm font-bold text-gray-800 block">{{ $item->aset->nama_aset ?? 'Aset Tidak Ditemukan' }}</span>
                                <span class="text-[11px] text-gray-400 italic">{{ $item->aset->lokasi ?? '-' }}</span>
                            </td>
                            
                            <td class="p-5 text-center">
                                <span class="text-sm font-semibold text-gray-600">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</span>
                            </td>

                            <td class="p-5 text-center">
                                <span class="text-sm font-semibold text-gray-600">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</span>
                            </td>

                            <td class="p-5 text-center">
                                @if($item->status_peminjaman == 'pending')
                                    <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider border border-blue-100">Verifikasi</span>
                                @elseif($item->status_peminjaman == 'disetujui')
                                    <span class="bg-yellow-50 text-yellow-600 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider border border-yellow-100">Diproses</span>
                                @elseif($item->status_peminjaman == 'ditolak')
                                    <span class="bg-red-50 text-red-500 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider border border-red-100">Ditolak</span>
                                @else
                                    <span class="bg-[#f1f5e9] text-[#588133] px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider border border-[#dce8c8]">Selesai</span>
                                @endif
                            </td>
                            
                            <td class="p-5">
                                <div class="flex items-center justify-center gap-2">
                                    @if($item->status_peminjaman == 'pending')
                                        <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="bg-[#588133] hover:bg-[#466629] text-white p-2.5 rounded-xl transition-all shadow-sm" title="Setujui">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            </button>
                                        </form>

                                        <button @click="openModal = true; selectedId = {{ $item->id }}" class="bg-white border border-red-200 text-red-500 hover:bg-red-50 p-2.5 rounded-xl transition-all shadow-sm" title="Tolak">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>

                                    @elseif($item->status_peminjaman == 'disetujui')
                                        <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="bg-[#588133] hover:bg-[#466629] text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase transition-all shadow-sm">
                                                Selesaikan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs font-medium italic">-</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-16 text-center bg-gray-50">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p class="text-sm font-medium">Belum ada riwayat pengajuan peminjaman.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 px-2 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium">
                    Total: {{ $peminjamans->total() ?? 0 }} Pengajuan
                </span>
            </div>
        </div>

        @if($peminjamans->hasPages())
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center gap-2">
                @if($peminjamans->onFirstPage())
                    <span class="px-4 py-2 bg-white border border-gray-200 text-gray-400 rounded-full text-sm font-bold cursor-not-allowed shadow-sm">← Sebelumnya</span>
                @else
                    <a href="{{ $peminjamans->previousPageUrl() }}" class="px-4 py-2 bg-white border border-gray-200 hover:border-[#588133] hover:text-[#588133] text-gray-600 rounded-full text-sm font-bold transition-all shadow-sm">← Sebelumnya</a>
                @endif

                <div class="flex gap-1">
                    @foreach($peminjamans->getUrlRange(1, $peminjamans->lastPage()) as $page => $url)
                        @if($page == $peminjamans->currentPage())
                            <span class="w-9 h-9 flex items-center justify-center bg-[#588133] text-white rounded-full text-sm font-bold shadow-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center bg-white border border-gray-200 hover:border-[#588133] text-gray-600 rounded-full text-sm font-bold transition-all">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                @if($peminjamans->hasMorePages())
                    <a href="{{ $peminjamans->nextPageUrl() }}" class="px-4 py-2 bg-[#588133] hover:bg-[#466629] text-white rounded-full text-sm font-bold transition-all shadow-sm">Selanjutnya →</a>
                @else
                    <span class="px-4 py-2 bg-white border border-gray-200 text-gray-400 rounded-full text-sm font-bold cursor-not-allowed shadow-sm">Selanjutnya →</span>
                @endif
            </nav>
        </div>
        @endif

        <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm" x-cloak x-transition>
            <div @click.away="openModal = false" class="bg-white rounded-3xl max-w-md w-full p-8 shadow-2xl">
                <h3 class="text-xl font-black text-gray-800 mb-6">Alasan Penolakan</h3>
                <textarea class="w-full border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-red-400 rounded-2xl p-4 h-32 text-sm focus:outline-none" placeholder="Tuliskan alasan penolakan di sini..."></textarea>
                <div class="flex gap-3 mt-6">
                    <button @click="openModal = false" class="flex-1 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-xl text-sm transition-colors">Batal</button>
                    <button class="flex-1 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl text-sm transition-colors shadow-md">Kirim Penolakan</button>
                </div>
            </div>
        </div>
    </div>

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