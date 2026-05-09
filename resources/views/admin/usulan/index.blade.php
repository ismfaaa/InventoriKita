<x-app-layout>
    @include('layouts.sidebar')
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        @if(session('status_berhasil'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('status_berhasil') }}",
                    confirmButtonColor: '#588133',
                    customClass: {
                        popup: 'rounded-[30px]',
                        confirmButton: 'rounded-xl px-6 py-2'
                    }
                });
            </script>
        @endif

        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-black text-[#588133]">Riwayat Usulan Pengadaan</h2>
                <p class="text-sm text-gray-500 mt-1">Status verifikasi dalam 24 jam</p>
            </div>
            {{-- Tombol (+) Masuk ke Halaman Create --}}
            <a href="{{ route('pengadaan.create') }}" class="bg-[#588133] hover:bg-[#466629] text-white w-14 h-14 rounded-2xl shadow-lg flex items-center justify-center transition-all duration-300 transform hover:scale-105">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v12m6-6H6"/></svg>
            </a>
        </div>
    </div>
</x-app-layout>