<x-app-layout>
    @include('layouts.sidebar')
    
    {{-- X-SLOT HEADER DIHAPUS TOTAL AGAR TIDAK ADA RUANG PUTIH DI BAWAH NAVBAR --}}

    {{-- WRAPPER UTAMA: Background senada dengan body agar mulus --}}
    <div class="bg-[#f8faf4] min-h-screen pt-8 pb-12 px-4 sm:px-6 lg:px-8 w-full" x-data="{ selectedLaporan: null }">
        
        {{-- CONTAINER UTAMA: SPLIT SCREEN (ITEMS-STRETCH AGAR TINGGI KIRI & KANAN SAMA) --}}
        <div class="max-w-[1400px] mx-auto flex flex-col lg:flex-row gap-6 items-stretch">
            
            {{-- ================= KOLOM KIRI: 3 WIDGET (BG HIJAU) ================= --}}
            <div class="w-full lg:w-[28%] flex flex-col gap-6">
                
                {{-- Card 1: Laporan Menunggu --}}
                <div class="bg-[#eef4e6] rounded-[20px] p-6 border border-[#dbe5ce] shadow-sm flex-1 flex flex-col justify-center">
                    <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Total Pending Laporan</p>
                    <div class="flex items-end gap-2">
                        <h4 class="text-3xl font-black text-[#4d732b]">12</h4>
                        <span class="text-xs text-gray-500 font-medium mb-1">Usulan</span>
                    </div>
                    {{-- Bar chart dummy ala gambar --}}
                    <div class="flex items-end gap-1.5 mt-4 h-6">
                        <div class="w-1/6 bg-[#b3c999] h-full rounded-sm"></div>
                        <div class="w-1/6 bg-[#b3c999] h-3/4 rounded-sm"></div>
                        <div class="w-1/6 bg-[#b3c999] h-1/2 rounded-sm"></div>
                        <div class="w-1/6 bg-[#b3c999] h-4/5 rounded-sm"></div>
                        <div class="w-1/6 bg-[#b3c999] h-full rounded-sm"></div>
                        <div class="w-1/6 bg-[#b3c999] h-2/3 rounded-sm"></div>
                    </div>
                </div>

                {{-- Card 2: Distribusi Kerusakan --}}
                <div class="bg-[#eef4e6] rounded-[20px] p-6 border border-[#dbe5ce] shadow-sm flex-1 flex flex-col justify-center">
                    <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-4">Request Count</p>
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between text-[11px] font-bold mb-1.5"><span class="text-gray-700">Berat</span><span class="text-gray-700">4</span></div>
                            <div class="w-full bg-[#dbe5ce] rounded-full h-2"><div class="bg-[#6b8e3c] h-2 rounded-full" style="width: 33%"></div></div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[11px] font-bold mb-1.5"><span class="text-gray-700">Sedang</span><span class="text-gray-700">5</span></div>
                            <div class="w-full bg-[#dbe5ce] rounded-full h-2"><div class="bg-[#6b8e3c] h-2 rounded-full" style="width: 42%"></div></div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[11px] font-bold mb-1.5"><span class="text-gray-700">Ringan</span><span class="text-gray-700">3</span></div>
                            <div class="w-full bg-[#dbe5ce] rounded-full h-2"><div class="bg-[#6b8e3c] h-2 rounded-full" style="width: 25%"></div></div>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Kesehatan Aset --}}
                <div class="bg-[#eef4e6] rounded-[20px] p-6 border border-[#dbe5ce] shadow-sm flex-1 flex flex-col justify-center">
                    <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Utilisasi Kesehatan</p>
                    <h4 class="text-3xl font-black text-[#4d732b] mb-4">92%</h4>
                    <div class="w-full bg-[#dbe5ce] rounded-full h-2.5">
                        <div class="bg-[#4d732b] h-2.5 rounded-full" style="width: 92%"></div>
                    </div>
                </div>

            </div>

            {{-- ================= KOLOM KANAN: TABEL DATA ================= --}}
            <div class="w-full lg:w-[72%] bg-white shadow-sm rounded-[20px] border border-gray-100 flex flex-col h-full overflow-hidden">
                
                {{-- HEADER TABEL: Judul, Search, & Filter (Style Gambar Pill Hijau Muda) --}}
                <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-50">
                    <div>
                        <h3 class="font-bold text-xl text-[#6b8e3c] leading-tight">Daftar Usulan Penanganan</h3>
                        <p class="text-xs text-gray-500 mt-1">Review dan kelola laporan kerusakan aset inventaris.</p>
                    </div>
                    
                    <form action="{{ route('feedback.pelaporan.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
                        
                        {{-- Input Search (Bentuk Pill Sesuai Potongan Gambar) --}}
                        <div class="flex items-center bg-[#f4f7f1] rounded-xl px-4 py-2.5 w-full sm:w-56 border border-transparent focus-within:border-[#6b8e3c] transition-colors">
                            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aset..." 
                                class="bg-transparent border-none focus:ring-0 text-xs ml-2 w-full outline-none text-gray-700 placeholder-gray-500 p-0" 
                                onkeydown="if(event.key === 'Enter') { this.form.submit(); return false; }">
                        </div>

                        {{-- Dropdown Filter Kategori (Bentuk Pill Sesuai Potongan Gambar) --}}
                        <div class="relative flex items-center bg-[#f4f7f1] rounded-xl px-4 py-2.5 w-full sm:w-44 border border-transparent hover:border-[#6b8e3c] transition-colors cursor-pointer">
                            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                            <select name="category" onchange="this.form.submit()" class="bg-transparent border-none focus:ring-0 text-xs font-medium ml-2 w-full outline-none appearance-none cursor-pointer text-gray-700 p-0">
                                <option value="">Filter Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ request('category') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>

                    </form>
                </div>

                {{-- TABEL UTAMA --}}
                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left border-collapse">
                        {{-- HEADER TABEL: BACKGROUND HIJAU SOLID --}}
                        <thead class="bg-[#6b8e3c] text-white">
                            <tr>
                                <th class="px-6 py-4 font-bold w-12 text-center text-[10px] uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 font-bold text-[10px] uppercase tracking-wider">Nama Aset</th>
                                <th class="px-6 py-4 font-bold text-[10px] uppercase tracking-wider text-center">Pengusul</th>
                                <th class="px-6 py-4 font-bold text-[10px] uppercase tracking-wider text-center">Kerusakan</th>
                                <th class="px-6 py-4 font-bold text-[10px] uppercase tracking-wider text-center">Tanggal</th>
                                <th class="px-6 py-4 font-bold text-[10px] uppercase tracking-wider text-center">Status</th>
                                <th class="px-6 py-4 font-bold text-[10px] uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 bg-white">
                            @forelse($pelaporans as $index => $laporan)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center text-gray-500 text-xs font-medium">{{ $pelaporans->firstItem() + $index }}</td>
                                <td class="px-6 py-4 text-xs font-bold text-gray-800">{{ $laporan->aset->nama_aset ?? 'Aset Tidak Ditemukan' }}</td>
                                <td class="px-6 py-4 text-center text-xs text-gray-600 font-medium">{{ $laporan->user->name ?? 'Admin' }}</td>
                                
                                <td class="px-6 py-4 text-center text-xs text-gray-600 font-medium uppercase">
                                    {{ $laporan->tingkat_kerusakan }}
                                </td>

                                <td class="px-6 py-4 text-center text-xs font-medium text-gray-500">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal_pelaporan)->format('d M Y') }}
                                </td>

                                {{-- BADGE STATUS: NO OUTLINE, ROUNDED-MD, SOFT BG (MUTLAK SESUAI GAMBAR) --}}
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusWarna = match($laporan->feedback) {
                                            'diperbaiki', 'diganti' => 'bg-[#dcfce7] text-[#15803d]', // Hijau Disetujui
                                            'dihilangkan' => 'bg-[#fee2e2] text-[#b91c1c]', // Merah Ditolak
                                            default => 'bg-[#fef3c7] text-[#c2410c]' // Kuning Pending
                                        };
                                        $statusTeks = $laporan->feedback ?? 'Pending';
                                    @endphp
                                    <span class="px-3 py-1.5 rounded-md text-[10px] font-bold uppercase tracking-wider {{ $statusWarna }}">
                                        {{ $statusTeks }}
                                    </span>
                                </td>

                                {{-- TOMBOL AKSI: MATA + DETAIL (BENTUK PILL OUTLINE HIJAU) --}}
                                <td class="px-6 py-4 text-center">
                                    <button @click="selectedLaporan = {{ $laporan->id }}" class="inline-flex items-center gap-1.5 bg-white border border-[#6b8e3c] text-[#6b8e3c] hover:bg-[#6b8e3c] hover:text-white px-4 py-1.5 rounded-full text-[10px] font-bold transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Detail
                                    </button>

                                    {{-- ================= SLIDE-OVER PANEL DETAIL ================= --}}
                                    <div x-show="selectedLaporan === {{ $laporan->id }}" class="fixed inset-0 z-[100] flex justify-end text-left" x-cloak>
                                        
                                        <div @click="selectedLaporan = null" 
                                             x-show="selectedLaporan === {{ $laporan->id }}"
                                             x-transition:enter="transition-opacity ease-linear duration-300"
                                             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                             x-transition:leave="transition-opacity ease-linear duration-300"
                                             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                             class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>
                                        
                                        <div x-show="selectedLaporan === {{ $laporan->id }}"
                                             x-transition:enter="transition ease-in-out duration-300 transform"
                                             x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                                             x-transition:leave="transition ease-in-out duration-300 transform"
                                             x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                                             class="relative w-full max-w-md h-full bg-white shadow-2xl flex flex-col z-10">
                                            
                                            <div class="flex items-center justify-between p-6 border-b border-gray-100 bg-white">
                                                <h3 class="text-lg font-bold text-[#6b8e3c]">Detail Usulan Penanganan</h3>
                                                <button @click="selectedLaporan = null" class="text-gray-400 hover:text-gray-600 bg-white border border-gray-200 rounded-full p-2 text-xs shadow-sm transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            </div>
                                            
                                            <div class="flex-1 overflow-y-auto p-6 space-y-6 table-scroll">
                                                
                                                {{-- 1. FOTO ASET (Sesuai Permintaan, Diletakkan Sebelum Informasi) --}}
                                                <div>
                                                    <h4 class="text-xs font-bold text-[#6b8e3c] mb-3 uppercase tracking-wider border-b border-gray-100 pb-2">Foto Kerusakan</h4>
                                                    @if($laporan->foto)
                                                        <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kerusakan" class="w-full h-48 object-cover rounded-xl border border-gray-200 shadow-sm">
                                                    @else
                                                        <div class="w-full h-48 bg-gray-50 rounded-xl flex flex-col items-center justify-center border border-gray-200 border-dashed">
                                                            <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                            <span class="text-xs text-gray-400">Tidak ada foto dilampirkan</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- 2. INFORMASI ASET --}}
                                                <div>
                                                    <h4 class="text-xs font-bold text-[#6b8e3c] mb-3 uppercase tracking-wider border-b border-gray-100 pb-2">Spesifikasi Laporan</h4>
                                                    <div class="bg-[#fcfdfa] rounded-xl p-4 border border-gray-100 space-y-3 text-xs">
                                                        <div class="flex justify-between border-b border-gray-50 pb-2"><span class="text-gray-500">Nama Item:</span><span class="font-bold text-gray-800">{{ $laporan->aset->nama_aset ?? 'Aset' }}</span></div>
                                                        <div class="flex justify-between border-b border-gray-50 pb-2"><span class="text-gray-500">Tingkat Kerusakan:</span><span class="font-black text-red-500 uppercase">{{ $laporan->tingkat_kerusakan }}</span></div>
                                                        <div class="flex justify-between"><span class="text-gray-500">Deskripsi:</span><span class="text-gray-700 text-right w-2/3">{{ $laporan->deskripsi ?? 'Perlu peninjauan teknis.' }}</span></div>
                                                    </div>
                                                </div>

                                                {{-- 3. INFORMASI PENGUSUL --}}
                                                <div>
                                                    <h4 class="text-xs font-bold text-[#6b8e3c] mb-3 uppercase tracking-wider border-b border-gray-100 pb-2">Informasi Pengusul</h4>
                                                    <div class="bg-[#fcfdfa] p-4 rounded-xl border border-gray-100 text-xs space-y-2">
                                                        <div class="flex justify-between"><span class="text-gray-500">Diusulkan Oleh:</span><span class="font-bold text-gray-800">{{ $laporan->user->name ?? 'Admin' }}</span></div>
                                                        <div class="flex justify-between"><span class="text-gray-500">Departemen/Lokasi:</span><span class="font-bold text-gray-800">{{ $laporan->lokasi ?? '-' }}</span></div>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- FOOTER: AKSI (TANPA ICON EMOJI) --}}
                                            <div class="p-6 bg-white border-t border-gray-100">
                                                <p class="text-xs text-center text-gray-500 mb-3">Pilih tindakan untuk usulan ini:</p>
                                                
                                                <form action="{{ route('feedback.pelaporan.updateStatus', $laporan->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status_pelaporan" value="selesai">
                                                    
                                                    @if ($laporan->status_pelaporan != 'selesai')
                                                        <div class="flex flex-col gap-2">
                                                            <select name="feedback" required class="w-full border border-gray-200 rounded-lg py-2.5 px-3 text-sm font-medium bg-gray-50 focus:ring-0 focus:border-[#6b8e3c] outline-none cursor-pointer">
                                                                <option value="" disabled selected>Pilih Keputusan...</option>
                                                                <option value="diperbaiki">Diperbaiki</option>
                                                                <option value="diganti">Diganti</option>
                                                                <option value="dihilangkan">Dihilangkan</option>
                                                            </select>
                                                            <button type="submit" class="w-full bg-[#6b8e3c] hover:bg-[#587a2f] text-white py-3 rounded-lg font-bold transition-colors text-sm mt-2 shadow-sm">
                                                                Simpan Keputusan
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div class="w-full bg-gray-100 text-gray-400 text-center py-3 rounded-lg font-bold text-sm cursor-not-allowed border border-gray-200">
                                                            Tindakan Selesai
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr><td colspan="7" class="px-6 py-12 text-center text-gray-400 text-xs font-medium">Belum ada laporan kerusakan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="p-4 border-t border-gray-100 bg-white">
                    <div class="pagination-matcha">
                        {{ $pelaporans->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STYLING --}}
    <style>
        [x-cloak] { display: none !important; }
        
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .pagination-matcha nav a, 
        .pagination-matcha nav span[aria-disabled="true"] span {
            background-color: white !important; 
            color: #6b8e3c !important; 
            border-radius: 6px;
            border-color: #f3f4f6 !important; 
            font-weight: 600;
            font-size: 0.75rem;
        }

        .pagination-matcha nav a:hover {
            background-color: #f8faf4 !important;
        }

        .pagination-matcha nav span[aria-current="page"] span {
            background-color: #6b8e3c !important;
            border-color: #6b8e3c !important;
            color: white !important;
            border-radius: 6px;
        }

        .table-scroll::-webkit-scrollbar { width: 4px; height: 4px; }
        .table-scroll::-webkit-scrollbar-track { background: transparent; }
        .table-scroll::-webkit-scrollbar-thumb { background-color: #e2e8f0; border-radius: 4px; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background-color: #cbd5e1; }
    </style>
</x-app-layout>