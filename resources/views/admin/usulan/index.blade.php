<x-app-layout>
    @include('layouts.sidebar')
    
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" x-data="{ showFilter: false }">
        
        @if(session('status_berhasil'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('status_berhasil') }}",
                    confirmButtonColor: '#588133',
                    customClass: {
                        popup: 'rounded-[30px]',
                        confirmButton: 'rounded-xl px-6 py-2'
                    }
                });
            </script>
        @endif

        {{-- HEADER & SEARCH/FILTER SECTION (Sejajar seperti di gambar referensi) --}}
        <div class="mb-6 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            
            {{-- KIRI: Judul Halaman --}}
            <div>
                <h3 class="text-2xl font-semibold text-[#588133]">Riwayat Usulan Pengadaan</h3>
                <p class="text-sm text-gray-500 mt-1">Status verifikasi dalam 24 jam</p>
            </div>

            {{-- KANAN: Form Search, Filter, & Tombol Buat Baru --}}
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                <form method="GET" action="{{ url()->current() }}" class="flex gap-2 w-full sm:w-auto m-0">
                    
                    {{-- Input Search --}}
                    <div class="relative w-full sm:w-56 lg:w-64">
                        <svg class="absolute left-4 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" placeholder="Cari aset..." value="{{ request('search') }}" 
                               class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-full focus:outline-none focus:ring-1 focus:ring-[#588133] focus:border-[#588133] text-sm text-gray-600 shadow-sm placeholder-gray-400 transition-all"
                               onkeydown="if(event.key === 'Enter') { this.form.submit(); return false; }">
                        
                        @if(request('status_pengadaan')) <input type="hidden" name="status_pengadaan" value="{{ request('status_pengadaan') }}"> @endif
                        @if(request('feedback_pengadaan')) <input type="hidden" name="feedback_pengadaan" value="{{ request('feedback_pengadaan') }}"> @endif
                    </div>
                    
                    {{-- Tombol Filter --}}
                    <button type="button" @click="showFilter = !showFilter" 
                            class="flex items-center gap-2 px-5 py-2 border border-gray-200 bg-white text-gray-600 hover:text-[#588133] hover:border-[#588133] rounded-full text-sm font-medium transition-colors shadow-sm shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        <span class="hidden sm:inline">Filter</span>
                    </button>
                </form>

                {{-- Tombol Tambah Pengadaan (+) --}}
                <a href="{{ route('pengadaan.create') }}" 
                   class="bg-[#588133] hover:bg-[#466629] text-white px-5 py-2 rounded-lg font-bold text-sm transition-all shadow-sm flex items-center justify-center gap-2 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Buat Baru
                </a>
            </div>
        </div>

        {{-- MENU FILTER DROPDOWN --}}
        <div x-show="showFilter" x-transition class="mb-6 bg-white rounded-2xl p-5 shadow-sm border border-gray-100" style="display: none;" x-cloak>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Filter Status --}}
                <div>
                    <label class="text-xs font-bold text-gray-700 mb-2 block">Status Pengadaan</label>
                    <form method="GET" action="{{ url()->current() }}">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('feedback_pengadaan')) <input type="hidden" name="feedback_pengadaan" value="{{ request('feedback_pengadaan') }}"> @endif
                        
                        <select name="status_pengadaan" onchange="this.form.submit()" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-[#588133] focus:border-[#588133] text-sm cursor-pointer shadow-sm bg-white">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status_pengadaan') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="selesai" {{ request('status_pengadaan') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </div>

                {{-- Filter Feedback --}}
                <div>
                    <label class="text-xs font-bold text-gray-700 mb-2 block">Feedback</label>
                    <form method="GET" action="{{ url()->current() }}">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('status_pengadaan')) <input type="hidden" name="status_pengadaan" value="{{ request('status_pengadaan') }}"> @endif

                        <select name="feedback_pengadaan" onchange="this.form.submit()" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-[#588133] focus:border-[#588133] text-sm cursor-pointer shadow-sm bg-white">
                            <option value="">Semua Feedback</option>
                            <option value="disetujui" {{ request('feedback_pengadaan') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('feedback_pengadaan') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        {{-- INDIKATOR FILTER AKTIF --}}
        @if(request('search') || request('status_pengadaan') || request('feedback_pengadaan'))
        <div class="flex flex-wrap gap-2 mb-4">
            @if(request('search'))
                <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">
                    🔍 {{ request('search') }}
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            @if(request('status_pengadaan'))
                <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">
                    Status: {{ ucfirst(request('status_pengadaan')) }}
                    <a href="{{ request()->fullUrlWithQuery(['status_pengadaan' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            @if(request('feedback_pengadaan'))
                <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">
                    Feedback: {{ ucfirst(request('feedback_pengadaan')) }}
                    <a href="{{ request()->fullUrlWithQuery(['feedback_pengadaan' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            <a href="{{ url()->current() }}" class="text-[#588133] hover:underline text-xs font-medium flex items-center ml-2 transition">Reset Semua</a>
        </div>
        @endif

        {{-- MAIN TABLE CARD (Desain Putih Besar dengan Header Hijau Solid) --}}
        <div class="bg-white shadow-sm rounded-3xl p-4 border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#769C4A] text-white uppercase text-[11px] font-bold tracking-wider">
                            <th class="p-4 rounded-tl-2xl w-16 text-center">NO</th>
                            <th class="p-4 w-1/3">ASET / BARANG</th>
                            <th class="p-4 text-center">ESTIMASI BIAYA</th>
                            <th class="p-4 text-center">TANGGAL DIBUAT</th>
                            <th class="p-4 text-center">FEEDBACK</th>
                            <th class="p-4 text-center rounded-tr-2xl">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pengadaans as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="p-4 text-center text-sm font-semibold text-gray-700">
                                {{ $index + 1 }}
                            </td>
                            <td class="p-4 text-sm text-gray-600">
                                <span class="font-semibold text-gray-800 block">{{ $item->aset->nama_aset ?? 'Aset Tidak Ditemukan' }}</span>
                            </td>
                            <td class="p-4 text-center">
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-100">
                                    <span class="text-[10px] font-black text-green-500">$</span> Rp {{ number_format($item->estimasi_biaya, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="p-4 text-center text-sm text-gray-600">
                                <div class="flex items-center justify-center gap-1.5">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                @if(strtolower($item->feedback_pengadaan) == 'disetujui')
                                    <span class="inline-block bg-green-50 text-green-600 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border border-green-100">{{ $item->feedback_pengadaan }}</span>
                                @elseif(strtolower($item->feedback_pengadaan) == 'ditolak')
                                    <span class="inline-block bg-red-50 text-red-600 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border border-red-100">{{ $item->feedback_pengadaan }}</span>
                                @else
                                    <span class="inline-block bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border border-yellow-100">{{ $item->feedback_pengadaan ?: '-' }}</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if(strtolower($item->status_pengadaan) == 'pending')
                                    <span class="inline-flex items-center gap-1 bg-gray-50 text-gray-600 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border border-gray-200">
                                        {{ $item->status_pengadaan }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-green-50 text-green-600 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border border-green-200">
                                        <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        {{ $item->status_pengadaan }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-16 text-center">
                                <p class="text-gray-400 text-sm">Belum ada riwayat usulan pengadaan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6 mb-10 pagination-matcha flex justify-center">
            {{ $pengadaans->appends(request()->query())->links() }}
        </div>         
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }
        
        /* Modifikasi Pagination agar lebih menyatu dengan layout baru */
        .pagination-matcha nav a, 
        .pagination-matcha nav span[aria-disabled="true"] span {
            background-color: white !important; 
            color: #588133 !important; 
            border-radius: 8px; /* Lebih kotak seperti referensi */
            border-color: #f3f4f6 !important; 
            font-size: 0.875rem;
            font-weight: 500;
        }

        .pagination-matcha nav a:hover {
            background-color: #f1f5e9 !important;
        }

        .pagination-matcha nav span[aria-current="page"] span {
            background-color: #588133 !important;
            border-color: #588133 !important;
            color: white !important;
            border-radius: 8px;
            font-weight: bold;
        }
    </style>
</x-app-layout>