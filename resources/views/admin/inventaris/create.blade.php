<x-app-layout>
    @include('layouts.sidebar')
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('inventaris.index') }}" class="text-gray-400 hover:text-[#588133] transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-[#588133] leading-tight">
                {{ __('Tambah Barang Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 p-8">
            
            {{-- Tampilkan Error Validasi Global --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            {{-- Icon silang merah --}}
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Lengkapi form dengan benar
                            </h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                {{-- Looping semua error yang ada --}}
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label for="kode_barang" class="block font-medium text-sm text-gray-700 mb-2">Kode Barang <span class="text-red-500">*</span></label>
                    <input type="text" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" placeholder="Contoh: CAM-001" 
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50" required>
                </div>

                <div class="mb-6">
                    <label for="nama_barang" class="block font-medium text-sm text-gray-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Contoh: Kamera Sony A6400" 
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="lokasi" class="block font-medium text-sm text-gray-700 mb-2">Kategori<span class="text-red-500">*</span></label>
                        <select id="kategori_id" name="kategori_id" value="{{ old('kategori_id') }}" required 
                            class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50">
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            
                            {{-- Looping data kategori --}}
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="lokasi" class="block font-medium text-sm text-gray-700 mb-2">Lokasi Penyimpanan <span class="text-red-500">*</span></label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Lemari A, Rak 2" 
                            class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50" required>
                    </div>
                </div>

                <div class="mb-8">
                    <label for="foto" class="block font-medium text-sm text-gray-700 mb-2">Foto Barang</label>
                    <input type="file" id="foto" name="foto" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#f1f5e9] file:text-[#588133] hover:file:bg-[#e2e8f0] transition duration-150">
                    <p class="mt-2 text-xs text-gray-400">Format: JPG, PNG. Maksimal 2MB.</p>
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-gray-100 pt-6">
                    <a href="{{ route('inventaris.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium transition duration-150">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#588133] text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-[#466629] transition duration-150 shadow-sm">
                        Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>