<x-app-layout>
    @include('layouts.sidebar')

    {{-- State Management Alpine.js untuk Panel & Modal --}}
    <div class="py-8 px-2 sm:px-6 lg:px-8 max-w-[1400px] mx-auto grid grid-cols-1 xl:grid-cols-12 gap-6 items-start" 
         x-data="{ 
            detailOpen: false, 
            rejectModal: false, 
            selectedId: null,
            selectedName: '',
            selectedPrice: '',
            selectedRequester: ''
         }">
        
        @if (session('status_berhasil'))
            <div class="xl:col-span-12 p-4 bg-[#f1f5e9] text-[#588133] border border-[#729c4b] rounded-xl font-medium text-sm flex items-center gap-2 mb-2" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('status_berhasil') }}
            </div>
        @endif

        {{-- ================= SIDEBAR CARDS (KIRI - 3 Kolom) ================= --}}
        <aside class="xl:col-span-3 space-y-5">
            {{-- Card 1 --}}
            <div class="stat-card">
                <div>
                    <div class="stat-title">Total Pending Cost</div>
                    <div class="stat-value">Rp 15.5M</div>
                </div>
                <div class="mini-chart">
                    <div class="chart-bar bar-1"></div><div class="chart-bar bar-2"></div>
                    <div class="chart-bar bar-3"></div><div class="chart-bar bar-4"></div>
                    <div class="chart-bar bar-5"></div><div class="chart-bar bar-6"></div>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="stat-card">
                <div>
                    <div class="stat-title">Request Count</div>
                    <div class="stat-value">12 <span class="text-sm font-normal text-gray-400">Usulan</span></div>
                </div>
                <div class="mini-chart">
                    <div class="chart-bar bar-3"></div><div class="chart-bar bar-5"></div>
                    <div class="chart-bar bar-2"></div><div class="chart-bar bar-6"></div>
                    <div class="chart-bar bar-4"></div><div class="chart-bar bar-1"></div>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="stat-card">
                <div>
                    <div class="stat-title">Utilisasi Anggaran</div>
                    <div class="stat-value">65%</div>
                </div>
                <div class="w-full bg-[#f1f5e9] h-2.5 rounded-full mt-4 overflow-hidden">
                    <div class="bg-[#588133] h-full rounded-full" style="width: 65%"></div>
                </div>
            </div>
        </aside>

        {{-- ================= AREA TABEL UTAMA (KANAN - 9 Kolom) ================= --}}
        <section class="xl:col-span-9 bg-white shadow-sm rounded-2xl border border-gray-200 flex flex-col h-[75vh] overflow-hidden">
            
            {{-- Header Tabel Gabungan --}}
            <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50/50 shrink-0">
                <div>
                    <h3 class="font-bold text-xl text-[#588133] leading-tight">Daftar Usulan Pengadaan</h3>
                    <p class="text-xs text-gray-500 mt-1">Review dan kelola pengajuan aset inventaris.</p>
                </div>
                
                {{-- Search Bar --}}
                <div class="relative w-full sm:w-64 h-10">
                    <form action="{{ route('pengadaan.index') }}" method="GET" class="h-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aset/pengusul..." 
                            class="w-full h-full pl-9 pr-4 text-[13px] border border-gray-200 rounded-lg focus:ring-[#588133] focus:border-[#588133] bg-white shadow-sm transition-all">
                    </form>
                </div>
            </div>

            {{-- Container Scroll Tabel --}}
            <div class="flex-1 overflow-auto table-scroll bg-white">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead class="sticky top-0 z-10 shadow-sm bg-[#729c4b]">
                        <tr>
                            <th class="p-3 font-bold w-12 text-center text-xs text-white uppercase tracking-wider">No</th>
                            <th class="p-3 font-bold text-xs text-white uppercase tracking-wider">Nama Aset</th>
                            <th class="p-3 font-bold text-xs text-white uppercase tracking-wider">Pengusul</th>
                            <th class="p-3 font-bold text-center text-xs text-white uppercase tracking-wider">Estimasi Harga</th>
                            <th class="p-3 font-bold text-center text-xs text-white uppercase tracking-wider">Qty</th>
                            <th class="p-3 font-bold text-center text-xs text-white uppercase tracking-wider">Tanggal</th>
                            <th class="p-3 font-bold text-center text-xs text-white uppercase tracking-wider">Status</th>
                            <th class="p-3 font-bold text-center text-xs text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($pengadaans as $key => $pengadaan)
                            <tr class="hover:bg-[#f8faf6] transition group">
                                <td class="p-3 text-center text-gray-500 text-[13px]">
                                    {{ $pengadaans->firstItem() + $key }}
                                </td>
                                <td class="p-3 font-semibold text-gray-800 text-[13px]">
                                    {{ $pengadaan->aset->nama_aset ?? '-' }}
                                </td>
                                <td class="p-3 text-[13px] text-gray-600">
                                    {{ $pengadaan->user->name ?? 'Admin' }}
                                </td>
                                <td class="p-3 text-center text-[13px] font-bold text-gray-700">
                                    Rp {{ number_format($pengadaan->estimasi_biaya, 0, ',', '.') }}
                                </td>
                                <td class="p-3 text-center text-[13px] text-gray-600">1</td>
                                <td class="p-3 text-center text-[13px] text-gray-500">
                                    {{ $pengadaan->created_at->format('d M Y') }}
                                </td>
                                <td class="p-3 text-center">
                                    @if($pengadaan->status_pengadaan == 'pending' && is_null($pengadaan->feedback_pengadaan))
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-[10px] font-bold uppercase">Pending</span>
                                    @else
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $pengadaan->feedback_pengadaan == 'disetujui' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $pengadaan->feedback_pengadaan ?? $pengadaan->status_pengadaan }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    {{-- Tombol Buka Panel Detail --}}
                                    <button @click="detailOpen = true; selectedId = {{ $pengadaan->id }}; selectedName = '{{ addslashes($pengadaan->aset->nama_aset ?? '-') }}'; selectedPrice = '{{ number_format($pengadaan->estimasi_biaya, 0, ',', '.') }}'; selectedRequester = '{{ addslashes($pengadaan->user->name ?? 'Admin') }}';" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#f1f5e9] hover:bg-[#588133] text-[#588133] hover:text-white border border-[#729c4b] rounded-lg text-xs font-semibold transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="p-8 text-center text-gray-400 text-sm">Data tidak ditemukan.</td></tr>
                        @endempty
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-3 border-t border-gray-100 bg-white shrink-0">
                <div class="pagination-matcha">{{ $pengadaans->appends(request()->query())->links() }}</div>
            </div>
        </section>

        {{-- ================= SLIDE-OVER DETAIL PANEL (MUNCUL DARI KANAN) ================= --}}
        <div x-show="detailOpen" class="fixed inset-0 z-50 overflow-hidden" x-cloak>
            {{-- Overlay Gelap --}}
            <div x-show="detailOpen" x-transition.opacity @click="detailOpen = false" class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
            
            {{-- Panel Kanan --}}
            <div x-show="detailOpen" 
                 x-transition:enter="transform transition ease-in-out duration-300" 
                 x-transition:enter-start="translate-x-full" 
                 x-transition:enter-end="translate-x-0" 
                 x-transition:leave="transform transition ease-in-out duration-300" 
                 x-transition:leave-start="translate-x-0" 
                 x-transition:leave-end="translate-x-full" 
                 class="absolute inset-y-0 right-0 w-full max-w-md bg-white shadow-2xl flex flex-col border-l border-gray-200">
                
                {{-- Panel Header --}}
                <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-[#f8faf6]">
                    <h2 class="text-lg font-bold text-[#588133]">Detail Usulan Pengadaan</h2>
                    <button @click="detailOpen = false" class="text-gray-400 hover:text-red-500 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Panel Content (Bisa di-scroll) --}}
                <div class="flex-1 overflow-y-auto p-6 space-y-6">
                    
                    {{-- Section: Spesifikasi --}}
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#729c4b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Spesifikasi Aset
                        </h4>
                        <div class="bg-gray-50 p-4 rounded-xl text-[13px] border border-gray-100">
                            <p class="mb-1"><span class="text-gray-500">Nama Item:</span> <strong class="text-gray-800" x-text="selectedName"></strong></p>
                            <p class="mb-1"><span class="text-gray-500">Estimasi Biaya:</span> <strong class="text-[#588133]">Rp <span x-text="selectedPrice"></span></strong></p>
                            <p><span class="text-gray-500">Kuantitas:</span> <strong>1 Unit</strong></p>
                            <hr class="my-3 border-gray-200">
                            <p class="text-gray-500 italic text-xs">*Detail spesifikasi teknis tambahan akan dilampirkan oleh admin jika tersedia.</p>
                        </div>
                    </div>

                    {{-- Section: Info Pengusul --}}
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#729c4b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Informasi Pengusul
                        </h4>
                        <div class="bg-gray-50 p-4 rounded-xl text-[13px] border border-gray-100">
                            <p class="mb-1"><span class="text-gray-500">Diusulkan Oleh:</span> <strong x-text="selectedRequester"></strong></p>
                            <p><span class="text-gray-500">Departemen:</span> <strong>Sistem Informasi / Laboratorium</strong></p>
                        </div>
                    </div>

                    {{-- Section: Timeline --}}
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#729c4b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Riwayat Pengajuan
                        </h4>
                        <div class="relative pl-4 border-l-2 border-[#d1e0c5] space-y-4 text-[13px]">
                            <div class="relative">
                                <div class="absolute -left-[21px] top-1 w-3 h-3 bg-[#588133] rounded-full ring-4 ring-white"></div>
                                <p class="font-bold text-gray-800">Menunggu Persetujuan</p>
                                <p class="text-xs text-gray-500">Saat ini di meja Stakeholder</p>
                            </div>
                            <div class="relative">
                                <div class="absolute -left-[21px] top-1 w-3 h-3 bg-gray-300 rounded-full ring-4 ring-white"></div>
                                <p class="font-bold text-gray-500">Pengajuan Dibuat</p>
                                <p class="text-xs text-gray-400">Oleh Admin</p>
                            </div>
                        </div>
                    </div>

                    {{-- Section: Lampiran (Mockup Dummy UI) --}}
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 mb-3">Dokumen Pendukung</h4>
                        <div class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer transition">
                            <div class="p-2 bg-red-100 text-red-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-[13px] font-bold text-gray-800">Invoice_Referensi.pdf</p>
                                <p class="text-[11px] text-gray-400">Klik untuk melihat pratinjau</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Panel Footer (Aksi) --}}
                <div class="p-5 border-t border-gray-200 bg-white shrink-0">
                    <p class="text-xs text-center text-gray-500 mb-3">Pilih tindakan untuk usulan ini:</p>
                    <div class="flex gap-3">
                        <button @click="rejectModal = true; detailOpen = false" class="flex-1 py-2.5 border-2 border-red-500 text-red-500 hover:bg-red-50 font-bold rounded-xl text-sm transition-colors">
                            Tolak Usulan
                        </button>
                        
                        <form :action="'/feedback-pengadaan/' + selectedId" method="POST" class="flex-1">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="disetujui">
                            <button type="submit" class="w-full py-2.5 bg-[#588133] hover:bg-[#466629] text-white font-bold rounded-xl text-sm shadow-md transition-colors">
                                Setujui Pengadaan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= MODAL PENOLAKAN (REJECT) ================= --}}
        <div x-show="rejectModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" x-cloak x-transition>
            <div @click.away="rejectModal = false" class="bg-white rounded-[30px] max-w-md w-full p-8 shadow-2xl">
                <h3 class="text-lg font-black text-gray-800 mb-4">Alasan Penolakan</h3>
                <form :action="'/feedback-pengadaan/' + selectedId" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="ditolak">
                    <textarea name="alasan" required class="w-full border-none bg-[#f1f5e9] rounded-2xl p-4 h-32 text-sm focus:ring-2 focus:ring-[#588133] outline-none" placeholder="Tulis alasan spesifik (misal: Anggaran departemen sudah habis)..."></textarea>
                    
                    <div class="flex gap-3 mt-6">
                        <button type="button" @click="rejectModal = false; detailOpen = true" class="flex-1 py-3 text-gray-500 hover:bg-gray-100 font-bold text-sm rounded-xl transition-colors">Kembali</button>
                        <button type="submit" class="flex-1 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl text-sm shadow-md transition-colors">Kirim Penolakan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- ================= STYLE TAMBAHAN ================= --}}
    <style>
        [x-cloak] { display: none !important; }
        
        /* Custom Scrollbar untuk Tabel */
        .table-scroll::-webkit-scrollbar { width: 8px; height: 8px; }
        .table-scroll::-webkit-scrollbar-track { background: #f8fafc; }
        .table-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; border: 2px solid #f8fafc; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background-color: #94a3b8; }

        /* Style Card Statistik */
        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 140px;
        }

        .stat-title {
            font-size: 12px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 800;
            color: #1f2937;
        }

        /* Grafik Mini */
        .mini-chart {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            height: 30px;
            margin-top: 10px;
        }
        .chart-bar {
            flex: 1;
            background: #729c4b;
            border-radius: 2px;
            opacity: 0.5;
            transition: opacity 0.2s;
        }
        .stat-card:hover .chart-bar { opacity: 0.9; }
        .bar-1 { height: 40%; } .bar-2 { height: 70%; } .bar-3 { height: 50%; }
        .bar-4 { height: 90%; } .bar-5 { height: 60%; } .bar-6 { height: 80%; }

        /* Pagination Alignment */
        .pagination-matcha nav a, 
        .pagination-matcha nav span[aria-disabled="true"] span {
            background-color: white !important; 
            color: #588133 !important; 
            border-radius: 8px;
            border-color: #e5e7eb !important; 
            font-size: 12px !important;
        }
        .pagination-matcha nav span[aria-current="page"] span {
            background-color: #588133 !important;
            border-color: #588133 !important;
            color: white !important;
            border-radius: 8px;
        }
    </style>
</x-app-layout>