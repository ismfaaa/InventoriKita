<x-app-layout>

    @include('layouts.sidebar')

    <x-slot name="header">
        {{-- CONTAINER UTAMA: Inisialisasi Alpine.js untuk kontrol dropdown melayang --}}
        <div x-data="{ showFilter: false }" class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-4 w-full">
            
            {{-- KIRI: Judul Halaman --}}
            <h2 class="font-semibold text-xl text-[#588133] leading-tight shrink-0">
                {{ __('Feedback Pengadaan') }}
            </h2>

            {{-- KANAN: Form Gabungan (Search & Filter) --}}
            <div class="flex flex-col sm:flex-row items-center gap-2 w-full md:w-auto">
                
                {{-- SATU FORM UTAMA: Menjamin fungsi search dan filter dropdown terkirim bersamaan --}}
                <form id="filterForm" action="{{ url()->current() }}" method="GET" class="flex w-full sm:w-auto gap-2 m-0 relative">
                    
                    {{-- Input Search --}}
                    <div class="relative w-full sm:w-56 lg:w-64">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengusul atau aset..." 
                            class="w-full pl-9 pr-4 py-2 border border-[#e5edda] bg-white rounded-xl focus:outline-none focus:ring-1 focus:ring-[#588133] focus:border-[#588133] text-sm shadow-sm transition-all" 
                            onkeydown="if(event.key === 'Enter') { this.form.submit(); return false; }">
                    </div>

                    {{-- Tombol Pemicu Dropdown Melayang --}}
                    <button type="button" @click="showFilter = !showFilter" 
                        class="bg-white border border-[#e5edda] text-[#588133] hover:bg-[#f1f5e9] px-3 py-2 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-sm shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span class="hidden sm:inline">Filter</span>
                    </button>

                    {{-- PANEL DROPDOWN MELAYANG: Berada di dalam form agar input select terbaca saat submit --}}
                    <div x-show="showFilter" @click.away="showFilter = false" 
                         x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 translate-y-[-10px] scale-95" 
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
                         x-transition:leave-end="opacity-0 translate-y-[-10px] scale-95" 
                         class="absolute right-0 top-full mt-2 w-full sm:w-[260px] p-4 bg-white border border-[#e5edda] rounded-2xl shadow-xl z-50 flex flex-col gap-3" 
                         style="display: none;" x-cloak>

                        {{-- Filter 2: Keputusan Tindakan --}}
                        <div>
                            <label class="text-xs font-bold text-gray-700 mb-1 block">Tindakan</label>
                            <select name="feedback_pengadaan" onchange="this.form.submit()" class="w-full px-3 py-2 border border-[#e5edda] rounded-xl focus:ring-[#588133] focus:border-[#588133] text-sm cursor-pointer shadow-sm bg-white text-gray-700">
                                <option value="">Semua Tindakan</option>
                                <option value="disetujui" {{ request('feedback_pengadaan') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="ditolak" {{ request('feedback_pengadaan') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    {{-- KONTEN UTAMA --}}
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" x-data="{ openModal: false, selectedId: null }">
        
        {{-- SUB-HEADER: Info Deskripsi Ringkas & Counter --}}
        <div class="mb-4 flex flex-col md:flex-row md:items-center justify-between gap-2">
            <div class="flex gap-2">
                <span class="bg-[#f1f5e9] text-[#588133] px-4 py-2 rounded-2xl text-xs font-bold border border-[#e5edda]">
                    Total Feedback: {{ count($pengadaans ?? []) }}
                </span>
            </div>
        </div> {{-- <-- INI TAG PENUTUP YANG DITAMBAHKAN --}}
        
        {{-- BUBBLE INDIKATOR FILTER AKTIF --}}
        @if(request('search') || request('status_pengadaan') || request('feedback_pengadaan'))
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            @if(request('search'))
                <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full text-xs font-bold border border-gray-200 shadow-sm">
                    🔍 "{{ request('search') }}"
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="hover:text-red-500 transition font-black ml-1">✕</a>
                </span>
            @endif
            @if(request('feedback_pengadaan'))
                <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-full text-xs font-bold border border-blue-100 shadow-sm">
                    Feedback: {{ ucfirst(request('feedback_pengadaan')) }}
                    <a href="{{ request()->fullUrlWithQuery(['feedback_pengadaan' => null]) }}" class="hover:text-red-500 transition font-black ml-1">✕</a>
                </span>
            @endif
            <a href="{{ url()->current() }}" class="text-gray-400 hover:text-gray-600 text-xs font-bold flex items-center ml-2 transition">Reset Semua</a>
        </div>
        @endif

        {{-- STRUKTUR TABEL UTAMA --}}
        <div class="bg-white overflow-hidden shadow-sm rounded-[30px] border border-[#e5edda]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="text-white sticky top-0 z-10 shadow-sm">
                        <tr>
                            <th class="bg-[#729c4b] p-4 font-bold w-16 text-center text-sm">No</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-sm">Pengusul</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-sm">Nama Aset</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-center text-sm">Estimasi Biaya</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-center text-sm">Status</th>
                            <th class="bg-[#729c4b] p-4 font-bold text-center text-sm">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($pengadaans as $key => $pengadaan)
                            <tr class="hover:bg-gray-50 transition group">
                                <td class="p-4 text-center text-gray-500 text-sm">
                                    {{ $pengadaans->firstItem() + $key }}
                                </td>
                                <td class="p-4 font-medium text-gray-800 text-sm">
                                    {{ $pengadaan->user->name ?? 'Anonim' }}
                                </td>
                                <td class="p-4 text-sm text-gray-600">
                                    {{ $pengadaan->aset->nama_aset ?? '-' }}
                                </td>
                                <td class="p-4 text-center text-sm font-bold text-gray-700">
                                    Rp {{ number_format($pengadaan->estimasi_biaya, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-center">
                                    @if($pengadaan->status_pengadaan === 'pending')
                                        <span class="bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-full text-[11px] font-bold border border-yellow-200 inline-block">Pending</span>
                                    @elseif($pengadaan->status_pengadaan === 'selesai')
                                        <span class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-full text-[11px] font-bold border border-blue-200 inline-block">Selesai ({{ ucfirst($pengadaan->feedback_pengadaan ?? '') }})</span>
                                    @else
                                        <span class="bg-[#f1f5e9] text-[#588133] px-3 py-1.5 rounded-full text-[11px] font-bold border border-[#d6e4c7] inline-block">{{ ucfirst($pengadaan->status_pengadaan) }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center text-sm text-gray-500">
                                    {{ $pengadaan->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-20 text-center"> <p class="text-gray-400 italic text-sm">Belum ada riwayat pengajuan pengadaan aset.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> 
        
        {{-- MODAL BOX --}}
        <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" x-cloak x-transition>
            <div @click.away="openModal = false" class="bg-white rounded-[40px] max-w-md w-full p-8 shadow-2xl">
                <h3 class="text-xl font-black text-gray-800 mb-6">Alasan Penolakan</h3>
                
                <form :action="'/stakeholder-feedback-pengadaan/' + selectedId + '/update-status'" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <input type="hidden" name="status" value="ditolak">
                    <textarea name="alasan" class="w-full border-none bg-[#f1f5e9] rounded-[25px] p-5 h-40 text-sm" placeholder="Tulis alasan..."></textarea>
                    
                    <div class="flex gap-4 mt-8">
                        <button type="button" @click="openModal = false" class="flex-1 py-4 text-gray-500 font-bold text-sm">Batal</button>
                        <button type="submit" class="flex-1 py-4 bg-red-500 text-white font-bold rounded-[20px] text-sm">Kirim</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MATCHA PAGINATION --}}
        <div class="mt-2 mb-15 pagination-matcha">
            {{ $pengadaans->appends(request()->query())->links() }}
        </div> 
    </div>

    <style>
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
            border-radius: 10px;
        }

        .table-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
        .table-scroll::-webkit-scrollbar-track { background: transparent; }
        .table-scroll::-webkit-scrollbar-thumb { background-color: #e2e8f0; border-radius: 8px; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background-color: #cbd5e1; }
    </style>
    
</x-app-layout>