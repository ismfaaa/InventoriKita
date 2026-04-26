{{-- Ini adalah Modal Pop-up, dipanggil dari index.blade.php --}}
<div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center" role="dialog">
    
    {{-- Background Hitam Transparan --}}
    <div @click="showEditModal = false" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
    
    {{-- Kotak Form Edit --}}
    <div class="relative w-full max-w-3xl mx-4 bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 p-8 z-50 max-h-[90vh] overflow-y-auto">
        
        <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
            <h2 class="font-bold text-2xl text-[#588133] leading-tight">Edit Aset</h2>
            <button type="button" @click="showEditModal = false" class="text-gray-400 hover:text-red-500 text-3xl leading-none">&times;</button>
        </div>

        <form action="{{ route('inventaris.update', $aset->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            
            <div class="mb-6">
                <label for="kode_barang" class="block font-medium text-sm text-gray-700 mb-2">Kode Barang <span class="text-red-500">*</span></label>
                <input type="text" id="kode_barang" name="kode_barang" value="{{ $aset->kode_aset }}" 
                    class="w-full border-gray-300 rounded-xl shadow-sm bg-gray-50 text-gray-500 cursor-not-allowed" readonly>
            </div>

            <div class="mb-6">
                <label for="nama_barang" class="block font-medium text-sm text-gray-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
                <input type="text" id="nama_barang" name="nama_barang" value="{{ $aset->nama_aset }}" 
                    class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    {{-- Ini diubah jadi Dropdown Kategori supaya logic-nya benar --}}
                    <label for="kategori_id" class="block font-medium text-sm text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select id="kategori_id" name="kategori_id" required 
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50">
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $aset->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="lokasi" class="block font-medium text-sm text-gray-700 mb-2">Lokasi Penyimpanan <span class="text-red-500">*</span></label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ $aset->lokasi }}" 
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50" required>
                </div>
            </div>

            <div class="mb-8">
                <label class="block font-medium text-sm text-gray-700 mb-2">Foto Saat Ini</label>
                <div class="mb-3 w-24 h-24 bg-gray-100 rounded-xl flex items-center justify-center border border-gray-200 overflow-hidden">
                    @if($aset->foto)
                        <img src="{{ asset('storage/' . $aset->foto) }}" alt="Foto" class="w-full h-full object-cover">
                    @else
                        <svg class="w-8 h-8 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                    @endif
                </div>
                
                <label for="foto" class="block font-medium text-sm text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                <input type="file" id="foto" name="foto" accept="image/*"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#f1f5e9] file:text-[#588133] hover:file:bg-[#e2e8f0] transition duration-150">
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-gray-100 pt-6">
                <button type="button" @click="showEditModal = false" class="text-gray-500 hover:text-gray-700 text-sm font-medium transition duration-150">
                    Batal
                </button>
                <button type="submit" class="bg-[#588133] text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-[#466629] transition duration-150 shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>