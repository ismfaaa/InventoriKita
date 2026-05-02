<form x-show="editing" action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="flex gap-2 items-center" style="display: none;">
                                    @csrf 
                                    @method('PUT')
                                    <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                                        class="border-gray-300 rounded-lg text-sm px-3 py-1 w-full focus:ring-[#588133] focus:border-[#588133]" required>
                                    
                                    <button type="submit" class="bg-green-500 text-white p-1.5 rounded-lg hover:bg-green-600 transition shadow-sm" title="Simpan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
            
                                    <button type="button" @click="editing = false" class="bg-gray-400 text-white p-1.5 rounded-lg hover:bg-gray-500 transition shadow-sm" title="Batal">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>