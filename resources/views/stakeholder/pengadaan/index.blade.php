<x-app-layout>
    @include('layouts.sidebar')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Feedback Pengadaan') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" x-data="{ openModal: false, selectedId: null }">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Daftar Feedback Pengadaan</h3>
                <p class="text-sm text-gray-500">Kelola dan pantau feedback terkait pengadaan aset secara real-time.</p>
            </div>
            <div class="flex gap-2">
                <span class="bg-[#f1f5e9] text-[#588133] px-4 py-2 rounded-2xl text-xs font-bold border border-[#e5edda]">
                    Total Feedback: {{ count($pengadaans ?? []) }}
                </span>
            </div>
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
                            <td colspan="6" class="p-20 text-center">
                                <p class="text-gray-400 italic text-sm">Belum ada riwayat pengajuan pengadaan aset.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

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
         <div class="mt-2 mb-15 pagination-matcha">
            {{ $pengadaans->appends(request()->query())->links() }}
        </div> 
    </div>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }

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
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>