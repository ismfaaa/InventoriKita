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

        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-black text-[#588133]">Riwayat Usulan Pengadaan</h2>
                <p class="text-sm text-gray-500 mt-1">Status verifikasi dalam 24 jam</p>
            </div>
            {{-- Tombol (+) Masuk ke Halaman Create --}}
            <a href="{{ route('pengadaan.create') }}" class="bg-[#588133] hover:bg-[#466629] text-white w-14 h-14 rounded-2xl shadow-lg flex items-center justify-center transition-all duration-300 transform hover:scale-105">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v12m6-6H6"/></svg>
            </a>
        </div>

            <div class="mb-6 relative">
                <form action="{{ url()->current() }}" method="GET">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pengusul atau nama aset..." class="block w-full pl-12 pr-4 py-3.5 border border-[#e5edda] bg-white rounded-2xl focus:ring-2 focus:ring-[#588133] focus:border-[#588133] text-sm shadow-sm transition-all">
                </form>
            </div>

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
                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-yellow-50 rounded-lg">
                                    <svg class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">{{ $item->feedback_pengadaan }}</span>
                                </div>
                            </td>
                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 rounded-lg">
                                    <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">
                                    {{ $item->status_pengadaan }}</span>
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
        
        /* 1. Atur kotak yang BELUM diklik (Link dan Tombol Panah Pasif) */
        .pagination-matcha nav a, 
        .pagination-matcha nav span[aria-disabled="true"] span {
            background-color: white !important; 
            color: #588133 !important; 
            border-radius: 12px;
            /* Opsional: tambah border abu-abu tipis agar senada dengan tabel */
            border-color: #f3f4f6 !important; 
        }

        /* 2. Efek saat disentuh mouse (Hover) */
        .pagination-matcha nav a:hover {
            background-color: #f1f5e9 !important;
        }

        /* 3. Atur kotak yang SEDANG AKTIF (Halaman saat ini) */
        .pagination-matcha nav span[aria-current="page"] span {
            background-color: #588133 !important;
            border-color: #588133 !important;
            color: white !important;
            border-radius: 12px;
        }
    </style>
</x-app-layout>