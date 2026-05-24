<x-app-layout>
 
    <div class="py-12 px-4 max-w-3xl mx-auto" x-data="{ namaAsetManual: '', asetIdTerpilih: '' }">
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
                <select name="aset_id" 
                        x-model="asetIdTerpilih"
                        :disabled="namaAsetManual.length > 0"
                        :required="namaAsetManual.length === 0"
                        class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133] disabled:bg-gray-100 disabled:text-gray-400 transition-all">
                    <option value="" selected>Pilih Aset...</option>
                    @foreach($asets as $aset)
                        <option value="{{ $aset->id }}">{{ $aset->kode_aset }} - {{ $aset->nama_aset }}</option>
                    @endforeach
                </select>
                @error('aset_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                <p class="text-xs text-gray-400 mt-1" x-show="namaAsetManual.length > 0">Request Aset</p>
            </div>

            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-gray-200"></div>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Usulkan Aset Baru</label>
                    <input type="text" 
                           name="nama_aset" 
                           x-model="namaAsetManual"
                           :disabled="asetIdTerpilih !== ''"
                           :required="asetIdTerpilih === ''"
                           placeholder="Ketik nama Aset baru di sini..." 
                           class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133] disabled:bg-gray-100 disabled:text-gray-400 transition-all">
                    @error('nama_aset') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kuantitas</label>
                    <input type="number" 
                           name="kuantitas" 
                           min="1" 
                           value="1" 
                           required
                           class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133]">
                    @error('kuantitas') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Estimasi Biaya (Rp)</label>
                <input type="number" name="estimasi_biaya" placeholder="Masukkan nominal biaya..." required min="0" 
                       class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133]">
                @error('estimasi_biaya') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-[#588133] hover:bg-[#466629] text-white font-bold py-4 rounded-2xl transition-all shadow-lg">
                Kirim Usulan Pengadaan
            </button>
        </form>
    </div>
</x-app-layout>