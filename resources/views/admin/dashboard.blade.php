<x-app-layout>
    {{-- Ambil data agar value di input tidak hilang saat refresh --}}
    @php
        $stats = \DB::table('dashboard_stats')->where('id', 1)->first();
    @endphp

    {{-- Kode Sidebar tetap di sini --}}
    <div>
        <div x-data="{ showSidebar: false }" @open-sidebar.window="showSidebar = true">
            {{-- ... (kode sidebar kamu) ... --}}
        </div>
    </div>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        {{-- 1. TAMBAHKAN TAG FORM DI SINI --}}
        <form action="{{ route('admin.update_stats') }}" method="POST">
            @csrf {{-- 2. WAJIB ADA UNTUK KEAMANAN LARAVEL --}}
            
            <div class="bg-gradient-to-br from-[#588133] to-[#99AF69] rounded-3xl p-6 text-white shadow-lg mb-8">
                <h3 class="text-xl font-bold">Manajemen Dashboard Real-time</h3>
                
                <div class="grid grid-cols-2 gap-4 mt-6">
                    {{-- Input Barang Tersedia --}}
                    <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                        <p class="text-xs uppercase font-bold opacity-80">Barang Tersedia</p>
                        <input type="number" name="barang_tersedia" 
                               value="{{ $stats->barang_tersedia ?? 0 }}"
                               min="0"
                               oninput="if(this.value < 0) this.value = 0;"
                               class="bg-transparent text-3xl font-bold opacity-80 w-full focus:outline-none border-b-2 border-white/30 focus:border-white">
                    </div>

                    {{-- Input Sedang Dipinjam --}}
                    <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                        <p class="text-xs uppercase font-bold opacity-80">Sedang Dipinjam</p>
                        {{-- 3. PERBAIKAN: name harus 'sedang_dipinjam' bukan 'barang_tersedia' --}}
                        <input type="number" name="sedang_dipinjam" 
                               value="{{ $stats->sedang_dipinjam ?? 0 }}" 
                               min="0"
                               oninput="if(this.value < 0) this.value = 0;"
                               class="bg-transparent text-3xl font-bold opacity-80 w-full focus:outline-none border-b-2 border-white/30 focus:border-white">
                    </div>
                </div>

                <button type="submit" class="mt-6 bg-[#99AF69] hover:bg-[#588133] text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md">
                    Update Dashboard Pengguna
                </button>
            </div>
        </form>
    </div>
</x-app-layout>