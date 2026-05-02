<x-app-layout>
    <div x-data="{ showSidebar: false }" @open-sidebar.window="showSidebar = true">
        <div x-show="showSidebar" class="fixed inset-0 z-50 flex" role="dialog" x-cloak>
            <div x-show="showSidebar" @click="showSidebar = false" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white shadow-xl">
                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="text-lg font-bold text-[#588133]">Menu Utama</h2>
                    <button @click="showSidebar = false" class="text-gray-500 text-2xl">&times;</button>
                </div>
                <div class="flex-1 overflow-y-auto p-4 space-y-2">
                    {{-- PERBAIKAN LINK DI SINI --}}
                    <a href="{{ route('pengguna.peminjaman.index') }}" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium transition-all">Form Peminjaman Baru</a>
                    <a href="#" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium transition-all">Form Pengembalian Alat</a>
                    <a href="{{ route('pengguna.lapor.create') }}" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium transition-all">Lapor Kerusakan Alat</a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="bg-gradient-to-br from-[#588133] to-[#99AF69] rounded-3xl p-6 text-white shadow-lg mb-8">
            <h3 class="text-xl font-bold">Halo, {{ Auth::user()->name }}! </h3>
            <p class="opacity-90 text-sm">Dashboard Real-time</p>
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                    <p class="text-xs uppercase font-bold opacity-80">Barang Tersedia</p>
                    <p class="text-2xl font-black">{{ $stats->barang_tersedia ?? 0 }}</p>
                </div>
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                    <p class="text-xs uppercase font-bold opacity-80">Sedang Dipinjam</p>
                    <p class="text-2xl font-black">{{ $stats->sedang_dipinjam ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white border-b border-[#e5edda]">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-bold text-2xl text-[#588133] leading-tight">Katalog Inventaris</h2>
                <p class="text-sm text-gray-500 mt-1">Pilih barang yang ingin Anda pinjam.</p>
                <div class="mt-6 relative">
                    <form action="{{ route('pengguna.index') }}" method="GET">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari alat multimedia, kabel, dll..." class="block w-full pl-10 pr-4 py-3 border-none bg-[#f1f5e9] rounded-2xl focus:ring-2 focus:ring-[#588133] text-sm">
                    </form>
                </div>
            </div>
        </div>

        {{-- Filter Kategori --}}
        <div class="py-8 px-0 max-w-7xl mx-auto">
            <div class="flex gap-2 overflow-x-auto pb-4 mb-4 no-scrollbar">
                <a href="{{ route('pengguna.index') }}" class="{{ !request('category') ? 'bg-[#588133] text-white border-[#588133]' : 'bg-white text-gray-600 border-gray-200' }} px-4 py-2 rounded-full text-xs font-bold whitespace-nowrap hover:bg-[#588133] hover:text-white transition-colors duration-300 border">Semua</a>
                @foreach ($kategoris as $kategori)
                    <a href="{{ route('pengguna.index', ['category' => $kategori->id, 'search' => request('search')]) }}" class="{{ request('category') == $kategori->id ? 'bg-[#588133] text-white border-[#588133]' : 'bg-white text-gray-600 border-gray-200' }} px-4 py-2 rounded-full text-xs font-bold whitespace-nowrap hover:bg-[#588133] hover:text-white transition-colors duration-300 border">{{ $kategori->nama_kategori }}</a>
                @endforeach     
            </div>
        </div>

        {{-- Grid Katalog --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($asets as $aset)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                <div class="aspect-square overflow-hidden bg-gray-100 flex items-center justify-center relative">
                    @if ($aset->foto)
                        <img src="{{ Storage::url($aset->foto) }}" alt="{{ $aset->nama_aset }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                    @endif
                    <span class="absolute top-2 right-2 bg-[#f1f5e9] text-[#588133] text-[10px] font-black px-2 py-1 rounded-lg uppercase">Tersedia</span>
                </div>
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-bold text-gray-800 text-sm line-clamp-2">{{ $aset->nama_aset }}</h3>
                    <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest font-bold">{{ $aset->lokasi }}</p>
                    <div class="mt-4 flex gap-2">
                        <button class="flex-1 bg-[#f1f5e9] text-[#588133] py-2 rounded-xl text-[10px] font-bold hover:bg-gray-200 transition-all duration-300">Detail</button>
                        
                        <button 
                            @click="$dispatch('open-pinjam-modal', { id: {{ $aset->id }}, nama: '{{ $aset->nama_aset }}' })"
                            class="flex-1 bg-[#588133] text-white py-2 rounded-xl text-[10px] font-bold text-center hover:bg-[#466629] transition-all duration-300 shadow-sm">
                            Pinjam
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-10 mb-24 pagination-matcha">
            {{ $asets->appends(request()->query())->links() }}
        </div>
    </div>

    {{-- MODAL PINJAM --}}
    <div x-data="{ open: false, asetId: null, asetNama: '' }" 
         @open-pinjam-modal.window="open = true; asetId = $event.detail.id; asetNama = $event.detail.nama"
         x-show="open" 
         class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="open = false"></div>
            <div x-show="open" x-transition.scale class="inline-block align-bottom bg-white rounded-[40px] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full p-8">
                <div class="text-center">
                    <h3 class="text-xl font-black text-gray-800">Pinjam Aset</h3>
                    <p class="text-sm text-gray-500 mt-2">Anda akan meminjam: <span class="font-bold text-[#588133]" x-text="asetNama"></span></p>
                </div>
                <form action="#" method="POST" class="mt-6 space-y-4">
                    @csrf
                    <input type="hidden" name="aset_id" :value="asetId">
                    <div>
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-2">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" required class="w-full mt-1 border-none bg-[#f1f5e9] rounded-2xl py-3 px-4 text-sm focus:ring-2 focus:ring-[#588133]">
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-2">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" required class="w-full mt-1 border-none bg-[#f1f5e9] rounded-2xl py-3 px-4 text-sm focus:ring-2 focus:ring-[#588133]">
                    </div>
                    <div class="pt-4 flex flex-col gap-2">
                        <button type="submit" class="w-full py-4 bg-[#588133] text-white font-bold rounded-2xl hover:bg-[#466629] transition-all">Kirim Pengajuan</button>
                        <button type="button" @click="open = false" class="w-full py-2 text-gray-400 font-bold text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }

        /* Custom Warna Pagination */
        .pagination-matcha nav span[aria-current="page"] span {
            background-color: #588133 !important;
            border-color: #588133 !important;
            color: white !important;
            border-radius: 12px;
        }
        .pagination-matcha nav a {
            border-radius: 12px;
            color: #588133 !important;
        }
        .pagination-matcha nav a:hover {
            background-color: #f1f5e9 !important;
        }
    </style>
</x-app-layout>