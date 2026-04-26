<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('inventaris.index') }}" class="text-gray-400 hover:text-[#588133] transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-[#588133] leading-tight">
                Tambah Kategori Baru
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 p-8">
            
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-xl text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="nama_kategori" class="block font-medium text-sm text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_kategori" name="nama_kategori" placeholder="Contoh: Alat Kebersihan" 
                        class="w-full border-gray-300 rounded-xl shadow-sm focus:border-[#588133] focus:ring focus:ring-[#588133] focus:ring-opacity-50" required>
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-gray-100 pt-6">
                    <a href="{{ route('inventaris.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium transition duration-150">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#588133] text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-[#466629] transition duration-150 shadow-sm">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>