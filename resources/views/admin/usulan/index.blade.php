<x-app-layout>
    @include('layouts.sidebar')
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
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

        {{-- HEADER: --}}
        <div x-data="{ showFilter: false }" class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-4 w-full mb-8">
            
            {{-- KIRI: Judul Halaman --}}
            <div class="shrink-0">
                <h2 class="text-3xl font-black text-[#588133]">Riwayat Usulan Pengadaan</h2>
                <p class="text-sm text-gray-500 mt-1">Status verifikasi dalam 24 jam</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-2 w-full md:w-auto">
                
                <form method="GET" action="{{ url()->current() }}" class="flex w-full sm:w-auto gap-2 m-0">
                    
                    {{-- Input Search --}}
                    <div class="relative w-full sm:w-56 lg:w-64">
                        <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" placeholder="Cari aset..." value="{{ request('search') }}" 
                            class="w-full pl-9 pr-4 py-2 border border-[#e5edda] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#588133] focus:border-[#588133] text-sm shadow-sm transition-all"
                            onkeydown="if(event.key === 'Enter') { this.form.submit(); return false; }">
                        
                        @if(request('status_pengadaan')) <input type="hidden" name="status_pengadaan" value="{{ request('status_pengadaan') }}"> @endif
                        @if(request('feedback_pengadaan')) <input type="hidden" name="feedback_pengadaan" value="{{ request('feedback_pengadaan') }}"> @endif
                    </div>
                    
                    {{-- Tombol Filter --}}
                    <button type="button" @click="showFilter = !showFilter" 
                            class="bg-white border border-[#e5edda] text-[#588133] hover:bg-[#f1f5e9] px-3 py-2 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-sm shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        <span class="hidden sm:inline">Filter</span>
                    </button>
                </form>

                {{-- Tombol Tambah Pengadaan (+) --}}
                <a href="{{ route('pengadaan.create') }}" 
                   class="bg-[#588133] hover:bg-[#466629] text-white px-5 py-2 rounded-xl font-bold text-sm transition-all shadow-sm flex items-center justify-center gap-2 group w-full sm:w-auto shrink-0">
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Buat Baru
                </a>
            </div>

            {{-- MENU FILTER DROPDOWN --}}
            <div x-show="showFilter" 
                 @click.away="showFilter = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-[-10px] scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-[-10px] scale-95"
                 class="absolute right-0 top-full mt-3 w-full sm:w-[400px] p-5 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 grid grid-cols-1 sm:grid-cols-2 gap-4" 
                 style="display: none;" x-cloak>
                 
                {{-- Filter Status --}}
                <div>
                    <label class="text-xs font-bold text-gray-700 mb-2 block">Status</label>
                    <form method="GET" action="{{ url()->current() }}">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('feedback_pengadaan')) <input type="hidden" name="feedback_pengadaan" value="{{ request('feedback_pengadaan') }}"> @endif
                        
                        <select name="status_pengadaan" onchange="this.form.submit()" class="w-full px-4 py-2 border border-[#e5edda] rounded-xl focus:ring-[#588133] focus:border-[#588133] text-sm cursor-pointer shadow-sm">
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

                        <select name="feedback_pengadaan" onchange="this.form.submit()" class="w-full px-4 py-2 border border-[#e5edda] rounded-xl focus:ring-[#588133] focus:border-[#588133] text-sm cursor-pointer shadow-sm">
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
                <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full text-xs font-bold border border-gray-200 shadow-sm">
                    🔍 {{ request('search') }}
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            @if(request('status_pengadaan'))
                <span class="inline-flex items-center gap-2 bg-green-50 text-green-600 px-3 py-1.5 rounded-full text-xs font-bold border border-green-100 shadow-sm">
                    Status: {{ ucfirst(request('status_pengadaan')) }}
                    <a href="{{ request()->fullUrlWithQuery(['status_pengadaan' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            @if(request('feedback_pengadaan'))
                <span class="inline-flex items-center gap-2 bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-full text-xs font-bold border border-yellow-100 shadow-sm">
                    Feedback: {{ ucfirst(request('feedback_pengadaan')) }}
                    <a href="{{ request()->fullUrlWithQuery(['feedback_pengadaan' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            <a href="{{ url()->current() }}" class="text-gray-400 hover:text-gray-600 text-xs font-bold flex items-center ml-2 transition">Reset Semua</a>
        </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm rounded-[30px] border border-[#e5edda]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#f8faf2] text-[#588133] text-[11px] uppercase tracking-widest">
                            <th class="p-5 font-black">No</th>
                            <th class="p-5 font-black">Aset / Barang</th>
                            <th class="p-5 font-black text-center">Estimasi Biaya</th>
                            <th class="p-5 font-black text-center">Tanggal Dibuat</th>
                            <th class="p-5 font-black text-center">Feedback</th>
                            <th class="p-5 font-black text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pengadaans as $index => $item)
                        <tr class="hover:bg-[#fcfdfa] transition-colors">
                            <td class="p-5 font-bold">{{ $index + 1 }}</td>
                            
                            <td class="p-5 text-sm text-gray-600">
                                <span class="font-semibold block">
                                    @if($item->aset_id)
                                        {{ $item->aset->nama_aset ?? 'Aset Tidak Ditemukan' }}
                                    @else
                                        {{ $item->nama_aset }}
                                    @endif
                                </span>
                            </td>

                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 rounded-lg">
                                    <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">Rp {{ number_format($item->estimasi_biaya, 0, ',', '.') }}</span>
                                </div>
                            </td>
                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-lg">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-yellow-50 rounded-lg">
                                    <svg class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">{{ $item->feedback_pengadaan ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 rounded-lg">
                                    <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">{{ $item->status_pengadaan }}</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-5 text-center text-gray-400 italic text-sm">Belum ada data pengadaan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-2 mb-15 pagination-matcha">
            {{ $pengadaans->appends(request()->query())->links() }}
        </div>         
    </div>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }
        
        .pagination-matcha nav a, 
        .pagination-matcha nav span[aria-disabled="true"] span {
            background-color: white !important; 
            color: #588133 !important; 
            border-radius: 12px;
            border-color: #f3f4f6 !important; 
        }

        .pagination-matcha nav a:hover {
            background-color: #f1f5e9 !important;
        }

        .pagination-matcha nav span[aria-current="page"] span {
            background-color: #588133 !important;
            border-color: #588133 !important;
            color: white !important;
            border-radius: 12px;
        }
    </style>
</x-app-layout>