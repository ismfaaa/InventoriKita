<x-app-layout>
    @include('layouts.sidebar')

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800">Lapor Kerusakan Aset</h3>
            <p class="text-sm text-gray-500">Mohon isi detail kerusakan dengan benar supaya dapat segera ditindaklanjuti.</p>
        </div>
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-4 rounded-2xl mb-4">
                    <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div>
            @endif

        <form action="{{ route('pengguna.lapor.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 rounded-[30px] shadow-sm border border-[#e5edda]">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="status_pelaporan" value="diproses">
            <input type="hidden" name="tanggal_pelaporan" value="{{ date('Y-m-d') }}">

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Aset yang Rusak</label>
                <select name="aset_id" required class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133] focus:ring-[#588133] transition-all">
                    <option value="" disabled selected>Pilih Aset...</option>
                    @foreach($asets as $aset)
                        <option value="{{ $aset->id }}" {{ old('aset_id') == $aset->id ? 'selected' : '' }}>
                            {{ $aset->kode_aset }} - {{ $aset->nama_aset }}
                        </option>
                    @endforeach
                </select>
                @error('aset_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tingkat Kerusakan</label>
                    <select name="tingkat_kerusakan" required class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133]">
                        <option value="ringan" {{ old('tingkat_kerusakan') == 'ringan' ? 'selected' : '' }}>Ringan (Masih bisa dipakai)</option>
                        <option value="sedang" {{ old('tingkat_kerusakan') == 'sedang' ? 'selected' : '' }}>Sedang (Perlu perbaikan segera)</option>
                        <option value="berat" {{ old('tingkat_kerusakan') == 'berat' ? 'selected' : '' }}>Berat (Tidak bisa dipakai/Mati total)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi Aset</label>
                    <input type="text" name="lokasi" placeholder="Contoh: Lab Komputer 1" required
                           class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Kerusakan</label>
                <textarea name="deskripsi" rows="4" placeholder="Jelaskan detail kerusakan" required
                          class="w-full rounded-2xl border-[#e5edda] focus:border-[#588133]">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Upload Bukti Foto</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-[#e5edda] border-dashed rounded-2xl hover:border-[#588133] transition-all">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label class="relative cursor-pointer bg-white rounded-md font-bold text-[#588133] hover:text-[#466629]">
                                <span>Unggah file</span>
                                <input name="foto" type="file" class="sr-only" required>
                                @error('foto') 
                                    <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> 
                                @enderror
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 10MB</p>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#588133] hover:bg-[#466629] text-white font-bold py-4 rounded-2xl shadow-lg transition-all transform hover:scale-[1.02]">
                Kirim Laporan Kerusakan
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('status_berhasil'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("status_berhasil") }}',
                confirmButtonColor: '#588133',
            });
        @endif

        @if(session('error_kritis'))
            Swal.fire({
                icon: 'warning',
                title: 'Aset sudah dilaporkan',
                text: '{{ session("error_kritis") }}',
                confirmButtonColor: '#588133',
            });
        @endif
    </script>
</x-app-layout>