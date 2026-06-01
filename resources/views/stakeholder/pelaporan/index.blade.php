<x-app-layout>
    @include('layouts.sidebar')

    <x-slot name="header">
        {{-- Kita jadikan header sebagai Flex Container dan inisialisasi Alpine.js --}}
        <div x-data="{ showFilter: false }" class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-4 w-full">
            
            {{-- KIRI: Judul Halaman --}}
            <h2 class="font-semibold text-xl text-[#588133] leading-tight shrink-0">
                {{ __('Pusat Keputusan Operasional Pelaporan') }}
            </h2>

            {{-- KANAN: Form Search, Filter --}}
            <div class="flex flex-col sm:flex-row items-center gap-2 w-full md:w-auto">
                
                <form method="GET" action="{{ url()->current() }}" class="flex w-full sm:w-auto gap-2 m-0">
                    
                    {{-- Input Search --}}
                    <div class="relative w-full sm:w-56 lg:w-64">
                        <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" placeholder="Cari aset atau lokasi..." value="{{ request('search') }}" 
                            class="w-full pl-9 pr-4 py-2 border border-[#e5edda] rounded-xl focus:outline-none focus:ring-1 focus:ring-[#588133] focus:border-[#588133] text-sm shadow-sm transition-all"
                            onkeydown="if(event.key === 'Enter') { this.form.submit(); return false; }">
                        
                        @if(request('status_pelaporan')) <input type="hidden" name="status_pelaporan" value="{{ request('status_pelaporan') }}"> @endif
                        @if(request('tingkat_kerusakan')) <input type="hidden" name="tingkat_kerusakan" value="{{ request('tingkat_kerusakan') }}"> @endif
                        @if(request('feedback')) <input type="hidden" name="feedback" value="{{ request('feedback') }}"> @endif
                        @if(request('kategori_aset')) <input type="hidden" name="kategori_aset" value="{{ request('kategori_aset') }}"> @endif
                    </div>
                    
                    {{-- Tombol Filter --}}
                    <button type="button" @click="showFilter = !showFilter" 
                            class="bg-white border border-[#e5edda] text-[#588133] hover:bg-[#f1f5e9] px-3 py-2 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-sm shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        <span class="hidden sm:inline">Filter</span>
                    </button>
                </form>
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
                 class="absolute right-0 top-full mt-3 w-full sm:w-[450px] p-5 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 grid grid-cols-1 sm:grid-cols-2 gap-4" 
                 style="display: none;" x-cloak>
                 
                 {{-- Filter Status --}}
                 <div>
                    <label class="text-xs font-bold text-gray-700 mb-2 block">Status Penanganan</label>
                    <form method="GET" action="{{ url()->current() }}">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('tingkat_kerusakan')) <input type="hidden" name="tingkat_kerusakan" value="{{ request('tingkat_kerusakan') }}"> @endif
                        
                        <select name="status_pelaporan" onchange="this.form.submit()" class="w-full px-4 py-2 border border-[#e5edda] rounded-xl focus:ring-[#588133] focus:border-[#588133] text-sm cursor-pointer shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="diproses" {{ request('status_pelaporan') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="verifikasi" {{ request('status_pelaporan') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                            <option value="feedback" {{ request('status_pelaporan') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                            <option value="selesai" {{ request('status_pelaporan') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </div>

                {{-- Filter Tingkat --}}
                <div>
                    <label class="text-xs font-bold text-gray-700 mb-2 block">Tingkat Kerusakan</label>
                    <form method="GET" action="{{ url()->current() }}">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('status_pelaporan')) <input type="hidden" name="status_pelaporan" value="{{ request('status_pelaporan') }}"> @endif
                        
                        <select name="tingkat_kerusakan" onchange="this.form.submit()" class="w-full px-4 py-2 border border-[#e5edda] rounded-xl focus:ring-[#588133] focus:border-[#588133] text-sm cursor-pointer shadow-sm">
                            <option value="">Semua Tingkat</option>
                            <option value="ringan" {{ request('tingkat_kerusakan') == 'ringan' ? 'selected' : '' }}>Ringan</option>
                            <option value="sedang" {{ request('tingkat_kerusakan') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="berat" {{ request('tingkat_kerusakan') == 'berat' ? 'selected' : '' }}>Berat</option>
                        </select>
                    </form>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-700 mb-2 block">Feedback</label>
                    <form method="GET" action="{{ url()->current() }}">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('status_pelaporan')) <input type="hidden" name="status_pelaporan" value="{{ request('status_pelaporan') }}"> @endif
                        @if(request('tingkat_kerusakan')) <input type="hidden" name="tingkat_kerusakan" value="{{ request('tingkat_kerusakan') }}"> @endif

                        <select name="feedback" onchange="this.form.submit()" class="w-full px-4 py-2 border border-[#e5edda] rounded-xl focus:ring-[#588133] focus:border-[#588133] text-sm cursor-pointer shadow-sm">
                            <option value="">Semua Feedback</option>
                            <option value="diperbaiki" {{ request('feedback') == 'diperbaiki' ? 'selected' : '' }}>Diperbaiki</option>
                            <option value="diganti" {{ request('feedback') == 'diganti' ? 'selected' : '' }}>Diganti</option>
                            <option value="dihilangkan" {{ request('feedback') == 'dihilangkan' ? 'selected' : '' }}>Dihilangkan</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    {{-- KONTEN UTAMA --}}
    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        {{-- INDIKATOR FILTER AKTIF (Tampil kalau ada filter yg dipakai) --}}
        @if(request('search') || request('status_pelaporan') || request('tingkat_kerusakan') || request('feedback') || request('kategori_aset'))
        <div class="flex flex-wrap gap-2 mb-4">
            @if(request('search'))
                <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full text-xs font-bold border border-gray-200 shadow-sm">
                    🔍 {{ request('search') }}
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            @if(request('status_pelaporan'))
                <span class="inline-flex items-center gap-2 bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-full text-xs font-bold border border-yellow-100 shadow-sm">
                    Status: {{ ucfirst(request('status_pelaporan')) }}
                    <a href="{{ request()->fullUrlWithQuery(['status_pelaporan' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            @if(request('tingkat_kerusakan'))
                <span class="inline-flex items-center gap-2 bg-red-50 text-red-600 px-3 py-1.5 rounded-full text-xs font-bold border border-red-100 shadow-sm">
                    Kerusakan: {{ ucfirst(request('tingkat_kerusakan')) }}
                    <a href="{{ request()->fullUrlWithQuery(['tingkat_kerusakan' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            @if(request('feedback'))
                <span class="inline-flex items-center gap-2 bg-purple-50 text-purple-600 px-3 py-1.5 rounded-full text-xs font-bold border border-purple-100 shadow-sm">
                    Feedback: {{ ucfirst(request('feedback')) }}
                    <a href="{{ request()->fullUrlWithQuery(['feedback' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            @if(request('kategori_aset'))
                @php
                    // Kita terjemahkan ID angka kembali menjadi nama kategori
                    $kategoriAktif = $asets->pluck('kategori')->where('id', request('kategori_aset'))->first();
                    $namaKategori = $kategoriAktif ? $kategoriAktif->nama_kategori : 'Filter Aktif';
                @endphp
                <span class="inline-flex items-center gap-2 bg-teal-50 text-teal-600 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100 shadow-sm">
                    Kategori: {{ $namaKategori }}
                    <a href="{{ request()->fullUrlWithQuery(['kategori_aset' => null]) }}" class="hover:text-red-500 transition">✕</a>
                </span>
            @endif
            <a href="{{ url()->current() }}" class="text-gray-400 hover:text-gray-600 text-xs font-bold flex items-center ml-2 transition">Reset Semua</a>
        </div>
        @endif

        {{-- TABEL DATA --}}
        <div class="bg-white overflow-hidden shadow-sm rounded-[30px] border border-[#e5edda]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#729c4b] text-white text-[11px] uppercase tracking-widest">
                            <th class="px-4 py-3 font-black">Aset & Lokasi</th>
                            <th class="px-4 py-3 font-black">Tingkat Kerusakan</th>
                            <th class="px-4 py-3 font-black">Tanggal Lapor</th>
                            <th class="px-4 py-3 font-black text-center">Bukti</th>
                            <th class="px-4 py-3 font-black text-center">Status</th>
                            <th class="px-4 py-3 font-black text-center">Aksi Feedback</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pelaporans as $laporan)
                        <tr class="hover:bg-[#fcfdfa] transition-colors">
                            <td class="px-4 py-2.5">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-gray-700">{{ $laporan->aset->nama_aset ?? 'Aset Tidak Diketahui' }}</span>
                                    <span class="text-[10px] text-gray-400 font-medium italic">{{ $laporan->lokasi }}</span>
                                </div>
                            </td>

                            <td class="px-4 py-2.5">
                                @php
                                    $colorClass = [
                                        'berat' => 'bg-red-50 text-red-600 border-red-100',
                                        'sedang' => 'bg-orange-50 text-orange-600 border-orange-100',
                                        'ringan' => 'bg-blue-50 text-blue-600 border-blue-100'
                                    ][$laporan->tingkat_kerusakan] ?? 'bg-gray-50 text-gray-600';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase border {{ $colorClass }}">
                                    {{ $laporan->tingkat_kerusakan }}
                                </span>
                            </td>

                            <td class="px-4 py-2.5 text-sm text-gray-500 font-medium">
                                {{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d M Y') }}
                            </td>

                            <td class="px-4 py-2.5 text-center">
                                @if($laporan->foto)
                                    <div class="w-10 h-10 rounded-lg overflow-hidden border border-gray-200 shadow-sm mx-auto">
                                        <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-full h-full object-cover shadow-sm" alt="Bukti Kerusakan">
                                    </div>
                                @else
                                    <span class="text-[10px] text-gray-300 italic">No Photo</span>
                                @endif
                            </td>
                            <td class="px-4 py-2.5 text-center">
                                @php
                                    $statusColor = [
                                        'diproses' => 'bg-yellow-50 text-yellow-600',
                                        'verifikasi' => 'bg-blue-50 text-blue-600',
                                        'feedback' => 'bg-orange-50 text-orange-600',
                                        'selesai' => 'bg-green-50 text-green-600'
                                    ][$laporan->status_pelaporan] ?? 'bg-gray-50 text-gray-600';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusColor }}">
                                    {{ $laporan->status_pelaporan }}
                                </span>
                            </td>                           

                            {{-- Kolom Aksi Khusus Stakeholder (Dropdown Update Feedback) --}}
                            <td class="px-4 py-2.5">
                                <form action="{{ route('feedback.pelaporan.updateStatus', $laporan->id) }}" method="POST" class="flex items-center justify-center gap-2 m-0" onsubmit="konfirmasiUpdate(event, this)">
                                    @csrf 
                                    @method('PATCH')
                                    
                                    {{-- Hidden input agar lolos validasi controller tanpa merubah status yang sedang berjalan --}}
                                    <input type="hidden" name="status_pelaporan" value="{{ $laporan->status_pelaporan }}">
                                    
                                    <select name="feedback" class="text-xs border-gray-200 text-gray-600 rounded-lg shadow-sm focus:border-[#588133] focus:ring-[#588133] py-1.5 pl-3 pr-8 cursor-pointer"
                                    {{ $laporan->status_pelaporan == 'selesai' ? 'disabled' : '' }}>
                                        <option value="" disabled {{ is_null($laporan->feedback) ? 'selected' : '' }}>Pilih Keputusan</option>
                                        <option value="diperbaiki" {{ $laporan->feedback == 'diperbaiki' ? 'selected' : '' }}>Diperbaiki</option>
                                        <option value="diganti" {{ $laporan->feedback == 'diganti' ? 'selected' : '' }}>Diganti</option>
                                        <option value="dihilangkan" {{ $laporan->feedback == 'dihilangkan' ? 'selected' : '' }}>Dihilangkan</option>
                                    </select>

                                    <button type="submit" {{ $laporan->status_pelaporan == 'selesai' ? 'disabled' : '' }} class="bg-[#588133] hover:bg-[#466629] text-white px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-tight transition-colors shadow-sm flex items-center gap-1 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="bg-[#f8faf2] p-4 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-[#588133] opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-400 italic text-sm">Belum ada laporan yang perlu di-review.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100 bg-white z-20 shrink-0">
                <div class="pagination-matcha">
                    {{ $pelaporans->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
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
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('status_berhasil') || session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('status_berhasil') ?? session('success') }}",
            confirmButtonColor: '#588133',
            customClass: {
                popup: 'rounded-[30px]',
                confirmButton: 'rounded-xl px-6 py-2'
            }
        });
    </script>
    @endif
    
    <script>
    function konfirmasiUpdate(event, formElement) {
        event.preventDefault(); 

        Swal.fire({
            title: 'Konfirmasi Keputusan',
            text: "Apakah Anda yakin dengan keputusan feedback untuk aset ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#588133',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-[30px]',
                confirmButton: 'rounded-xl px-4 py-2',
                cancelButton: 'rounded-xl px-4 py-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                formElement.submit(); 
            }
        });
    }
    </script>   
</x-app-layout>