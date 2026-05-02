<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.peminjaman.index') }}" class="text-gray-400 hover:text-[#588133] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-[#588133] leading-tight">
                {{ __('Detail Pengajuan Peminjaman') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="space-y-6">
                <div class="bg-white rounded-[35px] p-8 shadow-sm border border-[#e5edda] text-center">
                    <div class="w-20 h-20 bg-[#f1f5e9] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-[#588133]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h4 class="text-xs uppercase tracking-widest font-black text-gray-400 mb-2">Status Saat Ini</h4>
                    @if($peminjaman->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-2xl text-xs font-bold uppercase">Menunggu Persetujuan</span>
                    @elseif($peminjaman->status == 'disetujui')
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-2xl text-xs font-bold uppercase">Sedang Dipinjam</span>
                    @else
                        <span class="bg-[#f1f5e9] text-[#588133] px-4 py-2 rounded-2xl text-xs font-bold uppercase">Selesai Kembali</span>
                    @endif

                    <div class="mt-8 pt-8 border-t border-gray-50 flex flex-col gap-3">
                        @if($peminjaman->status == 'pending')
                            <button class="w-full py-4 bg-[#588133] text-white rounded-2xl font-bold shadow-lg shadow-[#588133]/20 hover:bg-[#466629] transition-all">Setujui Peminjaman</button>
                            <button class="w-full py-4 bg-white border border-red-100 text-red-500 rounded-2xl font-bold hover:bg-red-50 transition-all">Tolak Pengajuan</button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 space-y-6">
                <div class="bg-white rounded-[35px] p-8 shadow-sm border border-[#e5edda]">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#588133] rounded-full"></span>
                        Informasi Peminjam
                    </h3>
                    <div class="grid grid-cols-2 gap-y-6">
                        <div>
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-wider">Nama Lengkap</p>
                            <p class="text-sm font-bold text-gray-700">{{ $peminjaman->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-wider">Email/ID</p>
                            <p class="text-sm font-bold text-gray-700">{{ $peminjaman->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-wider">Keperluan</p>
                            <p class="text-sm text-gray-600 mt-1">{{ $peminjaman->keperluan ?? 'Untuk kegiatan operasional kantor' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[35px] p-8 shadow-sm border border-[#e5edda]">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#99AF69] rounded-full"></span>
                        Informasi Aset
                    </h3>
                    <div class="flex gap-6 items-start">
                        <div class="w-32 h-32 rounded-[25px] bg-gray-100 overflow-hidden border border-gray-50">
                             @if($peminjaman->aset->foto)
                                <img src="{{ Storage::url($peminjaman->aset->foto) }}" class="w-full h-full object-cover">
                             @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300 italic text-[10px]">No Photo</div>
                             @endif
                        </div>
                        <div class="flex-1 space-y-4">
                            <div>
                                <p class="text-[10px] uppercase font-black text-gray-400 tracking-wider">Nama Aset</p>
                                <p class="text-sm font-bold text-gray-700">{{ $peminjaman->aset->nama_aset }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[10px] uppercase font-black text-gray-400 tracking-wider">Lokasi</p>
                                    <p class="text-xs font-bold text-[#588133]">{{ $peminjaman->aset->lokasi }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-black text-gray-400 tracking-wider">Durasi</p>
                                    <p class="text-xs font-bold text-gray-700">{{ $peminjaman->tanggal_mulai }} s/d {{ $peminjaman->tanggal_selesai }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>