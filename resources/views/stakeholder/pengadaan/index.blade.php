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
            <!-- <div>
                <h3 class="text-2xl font-bold text-gray-800">Daftar Feedback Pengadaan</h3>
                <p class="text-sm text-gray-500">Kelola dan pantau feedback terkait pengadaan aset secara real-time.</p>
            </div> -->
            <div class="flex gap-2">
                <span class="bg-[#f1f5e9] text-[#588133] px-4 py-2 rounded-2xl text-xs font-bold border border-[#e5edda]">
                    Total Feedback: {{ count($pengadaans ?? []) }}
                </span>
            </div>
        </div>

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
                    <thead>
                        <tr class="bg-[#f8faf2] text-[#588133] text-[11px] uppercase tracking-widest">
                            <th class="p-5 font-black">Nama Pengusul</th>
                            <th class="p-5 font-black">Aset / Barang</th>
                            <th class="p-5 font-black text-center">Estimasi Biaya</th>
                            <th class="p-5 font-black text-center">Tanggal Dibuat</th>
                            <th class="p-5 font-black text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pengadaans as $item)
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

                            <td class="p-5">
                                <div class="flex justify-center gap-2">
                                    @if($item->status_pengadaan == 'pending' && is_null($item->feedback_pengadaan))
                                        <form action="{{ route('feedback.pengadaan.updateStatus', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="bg-[#588133] hover:bg-[#466629] text-white p-2.5 rounded-xl transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            </button>
                                        </form>

                                        <button @click="openModal = true; selectedId = {{ $item->id }}" class="bg-white border border-red-200 text-red-500 hover:bg-red-50 p-2.5 rounded-xl transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>

                                    @elseif($item->status_pengadaan == 'pending' && $item->feedback_pengadaan == 'disetujui')
                                        <form action="{{ route('feedback.pengadaan.updateStatus', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="bg-[#588133] text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase">
                                                Selesaikan
                                            </button>
                                        </form>
                                    
                                    @else
                                        <span class="text-gray-500 text-[10px] font-medium uppercase italic">{{ $item->feedback_pengadaan }}</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center">
                                <p class="text-gray-400 italic text-sm">Belum ada riwayat pengajuan pengadaan aset.</p>
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