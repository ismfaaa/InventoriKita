<x-app-layout>
    @include('layouts.sidebar')
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
                            {{-- HEADER DIPISAH JADI 2 --}}
                            <th class="p-5 font-black text-center">Tanggal Peminjaman</th>
                            <th class="p-5 font-black text-center">Tanggal Pengembalian</th>
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
                                        {{ substr($item->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-gray-700">{{ $item->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="p-5 text-sm text-gray-600">
                                <span class="font-semibold block">{{ $item->aset->nama_aset ?? 'Aset Tidak Ditemukan' }}</span>
                                <span class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $item->aset->lokasi ?? '-' }}</span>
                            </td>
                            
                            {{-- KOLOM 1: TANGGAL PEMINJAMAN --}}
                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-lg">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</span>
                                </div>
                            </td>

                            {{-- KOLOM 2: TANGGAL PENGEMBALIAN --}}
                            <td class="p-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-orange-50 rounded-lg">
                                    <svg class="w-3 h-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-sm font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</span>
                                </div>
                            </td>

                            <td class="p-5 text-center">
                                @if($item->status_peminjaman == 'pending')
                                    <span class="bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Menunggu</span>
                                @elseif($item->status_peminjaman == 'disetujui')
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Dipinjam</span>
                                @elseif($item->status_peminjaman == 'ditolak')
                                    <div class="flex flex-col items-center">
                                        <span class="bg-red-50 text-red-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Ditolak</span>
                                    </div>
                                @else
                                    <span class="bg-[#f1f5e9] text-[#588133] px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">Selesai</span>
                                @endif
                            </td>
                            <td class="p-5">
                                <div class="flex justify-center gap-2">
                                    @if($item->status_peminjaman == 'pending')
                                    <!-- TOMBOL SETUJUI -->
                                    <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit" class="bg-[#588133] hover:bg-[#466629] text-white p-2.5 rounded-xl transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                    </form>

                                    <!-- TOMBOL TOLAK -->
                                        <button @click="openModal = true; selectedId = {{ $item->id }}" class="bg-white border border-red-200 text-red-500 hover:bg-red-50 p-2.5 rounded-xl transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>

                                    @elseif($item->status_peminjaman == 'disetujui')
                                    <!-- TOMBOL SELESAIKAN -->
                                    <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="bg-[#588133] text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase">
                                            Selesaikan
                                        </button>
                                    </form>
                                    
                                    @else
                                        <span class="text-gray-300 text-[10px] font-medium uppercase italic">Archived</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-20 text-center">
                                <p class="text-gray-400 italic text-sm">Belum ada riwayat pengajuan peminjaman.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Tetap Sama --}}
        <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" x-cloak x-transition>
            <div @click.away="openModal = false" class="bg-white rounded-[40px] max-w-md w-full p-8 shadow-2xl">
                <h3 class="text-xl font-black text-gray-800 mb-6">Alasan Penolakan</h3>
                <textarea class="w-full border-none bg-[#f1f5e9] rounded-[25px] p-5 h-40 text-sm" placeholder="Tulis alasan..."></textarea>
                <div class="flex gap-4 mt-8">
                    <button @click="openModal = false" class="flex-1 py-4 text-gray-500 font-bold text-sm">Batal</button>
                    <button class="flex-1 py-4 bg-red-500 text-white font-bold rounded-[20px] text-sm">Kirim</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>