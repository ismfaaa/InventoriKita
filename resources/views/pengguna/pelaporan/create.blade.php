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
                    <div class="w-full max-w-xl border-2 border-dashed border-green-600 rounded-2xl p-6 flex flex-col items-center justify-center bg-white">
                        <div class="mb-2">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>

                        <img id="preview-foto" src="#" alt="Preview Foto" class="hidden w-32 h-32 object-cover rounded-xl mb-3 shadow">

                        <label class="relative cursor-pointer bg-white rounded-md font-bold text-[#588133] hover:text-[#466629] block text-center">
                            <span>Unggah file</span>
                            <input id="input-foto" name="foto" type="file" class="sr-only" accept="image/*" required>
                        </label>

                        <p id="nama-file" class="text-gray-400 text-sm mt-1 text-center">PNG, JPG, JPEG hingga 10MB</p>

                        @error('foto') 
                            <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> 
                        @enderror
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
    <script>
    const inputFoto = document.getElementById('input-foto');
    const previewFoto = document.getElementById('preview-foto');
    const teksNamaFile = document.getElementById('nama-file');
    const teksDefault = "PNG, JPG, JPEG hingga 10MB";

    inputFoto.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            teksNamaFile.textContent = file.name;
            teksNamaFile.classList.remove('text-gray-400');
            teksNamaFile.classList.add('text-gray-700', 'font-medium'); 

            const reader = new FileReader();
            reader.onload = function(e) {
                previewFoto.src = e.target.result;
                previewFoto.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            previewFoto.src = "#";
            previewFoto.classList.add('hidden');
            
            teksNamaFile.textContent = teksDefault;
            teksNamaFile.classList.remove('text-gray-700', 'font-medium');
            teksNamaFile.classList.add('text-gray-400');
        }
    });
</script>
</x-app-layout>