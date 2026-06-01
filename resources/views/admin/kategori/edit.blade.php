{{-- MODAL EDIT KATEGORI --}}
<div x-show="editing" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    {{-- Latar Belakang Gelap (Backdrop) --}}
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        
        <div x-show="editing" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" 
             @click="editing = false" aria-hidden="true"></div>

        {{-- Trik untuk menengahkan modal secara vertikal di layar PC --}}
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        {{-- Kotak Modal --}}
        <div x-show="editing" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf 
                @method('PUT')
                
                {{-- Judul dan Input --}}
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">
                            Edit Kategori
                        </h3>
                        <div class="mt-4">
                            <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                                class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:ring-[#588133] focus:border-[#588133] shadow-sm transition-all" required>
                        </div>
                    </div>
                </div>
                
                {{-- Tombol Aksi --}}
                <div class="mt-6 sm:flex sm:flex-row-reverse gap-2">
                    <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-[#588133] text-sm font-bold text-white hover:bg-[#466629] focus:outline-none sm:w-auto transition-all">
                        Simpan Perubahan
                    </button>
                    <button type="button" @click="editing = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-bold text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto transition-all">
                        Batal
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>