<!-- {{-- Header Modal --}}
<div class="p-6 border-b border-gray-100 flex justify-between items-center bg-[#588133]/5">
    <h3 class="font-bold text-gray-800">Detail Laporan #{{ $laporan->id }}</h3>
    <button @click="selectedLaporan = null" class="text-gray-400 hover:text-red-500 text-2xl leading-none">&times;</button>
</div>

{{-- Isi/Body Modal --}}
<div class="p-8 space-y-6">
    <div class="flex gap-6 items-start">
        <div class="w-28 h-28 rounded-2xl bg-gray-100 border border-gray-200 overflow-hidden shrink-0">
            @if($laporan->foto)
                <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-[10px] text-gray-400 italic">No Photo</div>
            @endif
        </div>
        <div>
            <h4 class="text-xl font-bold text-gray-800">{{ $laporan->aset->nama_aset ?? 'Aset Tidak Terdaftar' }}</h4>
            <p class="text-xs text-gray-500 mt-1 italic">{{ $laporan->lokasi ?? 'Lokasi tidak tersedia' }}</p>
            <div class="mt-3 flex gap-2">
                <span class="px-2 py-0.5 rounded-md text-[9px] font-bold uppercase {{ $laporan->tingkat_kerusakan == 'berat' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600' }}">
                    {{ $laporan->tingkat_kerusakan }}
                </span>
                <span class="px-2 py-0.5 rounded-md text-[9px] font-bold uppercase bg-blue-100 text-blue-600">
                    {{ $laporan->status_pelaporan }}
                </span>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 text-sm text-gray-600 italic">
        "{{ $laporan->deskripsi }}"
    </div>

    <div class="grid grid-cols-2 gap-4 pt-2 border-t border-gray-100">
        <div>
            <p class="text-[9px] text-gray-400 uppercase font-bold">Waktu Masuk</p>
            <p class="text-xs font-semibold text-gray-700">{{ $laporan->created_at->format('d M Y, H:i') }} WIB</p>
        </div>
        @if($laporan->created_at != $laporan->updated_at)
        <div>
            <p class="text-[9px] text-[#588133] uppercase font-bold">Terakhir Diupdate</p>
            <p class="text-xs font-semibold text-gray-700">{{ $laporan->updated_at->format('d M Y, H:i') }} WIB</p>
        </div>
        @endif
    </div>
</div> -->