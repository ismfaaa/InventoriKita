{{-- PEMINJAMAN PENGGUNA --}}

<x-app-layout>
    @include('layouts.sidebar')
    
     
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Peminjaman') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Konten halaman manajemen peminjaman -->
                    <p>Selamat datang di halaman manajemen peminjaman. Di sini Anda dapat melihat daftar peminjaman yang telah dilakukan, mengajukan peminjaman baru, dan mengelola peminjaman yang sedang berlangsung.</p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>