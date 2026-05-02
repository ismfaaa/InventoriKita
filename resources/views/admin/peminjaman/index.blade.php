<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Manajemen Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" x-data="{ openModal: false, selectedId: null }">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Daftar Aktivitas Aset</h3>
                <p class="text-sm text-gray-500">Kelola persetujuan dan pantau status peminjaman secara real-time.</p>
            </div>
            <div class="flex gap-2">
                <span class="bg-[#f1f5e9] text-[#588133] px-4 py-2 rounded-2xl text-xs font-bold border border-[#e5edda]">
                    Total Pengajuan: {{ count($peminjamans ?? []) }}
                </span>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-[30px] border border-[#e5edda]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#f8faf2] text-[#588133] text-[11px] uppercase tracking-widest">
                            <th class="p-5 font-black">Peminjam</th>
                            <th class="p-5 font-black">Aset / Barang</th>
                            <th class="p-5 font-black">Durasi Pinjam</th>
                            <th class="p-5 font-black text-center">Status</th>
                            <th class="p-5 font-black text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($peminjamans as $item)
                        <tr class="hover:bg-[#fcfdfa] transition-colors">
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#99AF69] flex items-center justify-center text-white text-xs font-bold">
                                        {{ substr($item->user->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-gray-700">{{ $item->user->name }}</span>
                                </div>
                            </td>
                            <td class="p-5 text-sm text-gray-600">
                                <span class="font-semibold block">{{ $item->aset->nama_aset }}</span>
                                <span class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $item->aset->lokasi }}</span>
                            </td>
                            <td class="p-5 text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M') }} - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                </div>
                            </td>
                            <td class="p-5 text-center">
                                @if($item->status == 'pending')
                                    <span class="bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Menunggu</span>
                                @elseif($item->status == 'disetujui')
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Dipinjam</span>
                                @elseif($item->status == 'ditolak')
                                    <div class="flex flex-col items-center">
                                        <span class="bg-red-50 text-red-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Ditolak</span>
                                        @if($item->alasan_tolak)
                                            <span class="text-[9px] text-red-400 mt-1 italic italic">"{{ $item->alasan_tolak }}"</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="bg-[#f1f5e9] text-[#588133] px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Selesai</span>
                                @endif
                            </td>
                            <td class="p-5">
                                <div class="flex justify-center gap-2">
                                    @if($item->status == 'pending')
                                        <button class="bg-[#588133] hover:bg-[#466629] text-white p-2.5 rounded-xl transition-all shadow-sm shadow-[#588133]/20">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                        <button @click="openModal = true; selectedId = {{ $item->id }}" class="bg-white border border-red-200 text-red-500 hover:bg-red-50 p-2.5 rounded-xl transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    @elseif($item->status == 'disetujui')
                                        <button class="bg-[#588133] text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase hover:bg-[#466629] transition-all">
                                            Selesaikan
                                        </button>
                                    @else
                                        <span class="text-gray-300 text-[10px] font-medium uppercase italic">Archived</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <p class="text-gray-400 italic text-sm">Belum ada riwayat pengajuan peminjaman.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="openModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
             x-cloak>
            
            <div @click.away="openModal = false" 
                 class="bg-white rounded-[40px] max-w-md w-full p-8 shadow-2xl transform transition-all">
                <div class="mb-6">
                    <h3 class="text-xl font-black text-gray-800">Alasan Penolakan</h3>
                    <p class="text-sm text-gray-500 mt-1">Sistem akan mengirimkan pesan ini ke pengguna.</p>
                </div>
                
                <textarea placeholder="Tuliskan alasan penolakan di sini... (Contoh: Barang dalam perawatan)" 
                    class="w-full border-none bg-[#f1f5e9] rounded-[25px] focus:ring-2 focus:ring-[#588133] text-sm p-5 h-40 placeholder:text-gray-400"></textarea>
                
                <div class="flex gap-4 mt-8">
                    <button @click="openModal = false" class="flex-1 py-4 text-gray-500 font-bold text-sm hover:text-gray-700 transition-colors">Batal</button>
                    <button class="flex-1 py-4 bg-red-500 text-white font-bold rounded-[20px] text-sm shadow-lg shadow-red-200 hover:bg-red-600 transition-all">Kirim Penolakan</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>