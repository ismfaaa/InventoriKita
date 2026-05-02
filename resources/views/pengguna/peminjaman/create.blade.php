<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('peminjaman.index') }}" class="text-gray-400 hover:text-[#588133] transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-[#588133] leading-tight">
                {{ __('Ajukan Peminjaman Aset') }}
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
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Periksa kembali isian Anda</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                
                {{-- Pilih Aset --}}
                <div class="mb-6">
                    <label for="aset_id" class="block font-medium text-sm text-gray-700 mb-2">Pilih Barang / Aset <span class="text-red-500">*</span></label>
                    <select id="aset_id" name="aset_id" required 
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50 text-gray-600">
                        <option value="" disabled selected>-- Pilih Barang yang akan dipinjam --</option>
                        @foreach($asets as $aset)
                            <option value="{{ $aset->id }}" {{ old('aset_id') == $aset->id ? 'selected' : '' }}>
                                {{ $aset->nama_aset }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    {{-- Tanggal Pinjam --}}
                    <div>
                        <label for="tanggal_pinjam" class="block font-medium text-sm text-gray-700 mb-2">Tanggal Pinjam <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" 
                            class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50 text-gray-600" required>
                    </div>

                    {{-- Tanggal Kembali --}}
                    <div>
                        <label for="tanggal_kembali" class="block font-medium text-sm text-gray-700 mb-2">Tanggal Kembali <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" 
                            class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50 text-gray-600" required>
                    </div>
                </div>

                {{-- Status Info (Read Only) --}}
                <div class="mb-8">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Status Awal</label>
                    <div class="w-full bg-[#f1f5e9] text-[#588133] px-4 py-2 rounded-xl text-sm font-semibold border border-[#e2e8f0]">
                        Menunggu Persetujuan (Pending)
                    </div>
                    {{-- Hidden inputs untuk data otomatis --}}
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="status_peminjaman" value="pending">
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-gray-100 pt-6">
                    <a href="{{ route('peminjaman.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium transition duration-150">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#588133] text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-[#466629] transition duration-150 shadow-sm">
                        Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>