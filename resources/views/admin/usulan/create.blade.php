<x-app-layout>
    <div class="py-12 px-4 max-w-3xl mx-auto">
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800">Formulir Usulan Pengadaan</h3>
            <p class="text-sm text-gray-500">Silakan isi detail usulan aset baru di bawah ini.</p>
        </div>

        <form action="{{ route('pengadaan.store') }}" method="POST" class="space-y-6 bg-white p-8 rounded-[30px] shadow-sm border border-[#e5edda]">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="status_pengadaan" value="pending">
            <input type="hidden" name="tanggal_pengadaan" value="{{ date('Y-m-d') }}">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Aset dari Katalog</label>
                <select name="aset_id" required class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133] transition-all">
                    <option value="" disabled selected>Pilih Aset...</option>
                    @foreach($asets as $aset)
                        <option value="{{ $aset->id }}">{{ $aset->kode_aset }} - {{ $aset->nama_aset }}</option>
                    @endforeach
                </select>
                @error('aset_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Estimasi Biaya (Rp)</label>
                <input type="number" name="estimasi_biaya" placeholder="Masukkan nominal biaya..." required min="0" 
                       class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133]">
            </div>

            <button type="submit" class="w-full bg-[#588133] hover:bg-[#466629] text-white font-bold py-4 rounded-2xl transition-all shadow-lg">
                Kirim Usulan Pengadaan
            </button>
        </form>
    </div>
</x-app-layout>

 