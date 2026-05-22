<x-app-layout>
    @include('layouts.sidebar')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buku Pedoman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="flex flex-col items-center text-center">
                    <!-- Icon -->
                    <div class="mb-6">
                        <svg class="w-16 h-16 text-[#588133] mx-auto" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                        </svg>
                    </div>

                    <!-- Description -->
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Panduan Penggunaan Sistem</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed max-w-2xl">
                        Buku pedoman ini berisi dokumentasi lengkap tentang cara menggunakan sistem InventoriKita, 
                        termasuk fitur-fitur utama, panduan langkah demi langkah, dan tips penggunaan.
                    </p>

                    <!-- Download Button -->
                    <a href="{{ route('pedoman.download') }}" 
                       class="inline-flex items-center gap-2 bg-[#588133] hover:bg-[#477428] text-white font-semibold py-3 px-8 rounded-lg transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Download Buku Pedoman (PDF)
                    </a>

                    <!-- Info -->
                    <p class="text-sm text-gray-500 mt-6">
                        Format: PDF
                    </p>
                </div>

                <!-- Additional Info Section -->
                <div class="mt-12 grid md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-[#f1f5e9] to-white rounded-xl shadow-sm p-6 text-center border border-[#e5edda]">
                        <svg class="w-8 h-8 text-[#588133] mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12a1 1 0 110-2h6a1 1 0 110 2H9z"></path>
                            <path fill-rule="evenodd" d="M2 3a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H3a1 1 0 01-1-1V3zm2 2v10h10V5H4z" clip-rule="evenodd"></path>
                        </svg>
                        <h3 class="font-semibold text-gray-800 mb-2">Dokumentasi</h3>
                        <p class="text-sm text-gray-600">Panduan lengkap fitur sistem</p>
                    </div>

                    <div class="bg-gradient-to-br from-[#f1f5e9] to-white rounded-xl shadow-sm p-6 text-center border border-[#e5edda]">
                        <svg class="w-8 h-8 text-[#588133] mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        <h3 class="font-semibold text-gray-800 mb-2">Instruksi Step-by-Step</h3>
                        <p class="text-sm text-gray-600">Petunjuk detail penggunaan</p>
                    </div>

                    <div class="bg-gradient-to-br from-[#f1f5e9] to-white rounded-xl shadow-sm p-6 text-center border border-[#e5edda]">
                        <svg class="w-8 h-8 text-[#588133] mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                        </svg>
                        <h3 class="font-semibold text-gray-800 mb-2">Tips & Trik</h3>
                        <p class="text-sm text-gray-600">Maksimalkan penggunaan sistem</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
