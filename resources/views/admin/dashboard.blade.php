<x-app-layout>
    @php
        $stats = \DB::table('dashboard_stats')->where('id', 1)->first();
    @endphp

    @include('layouts.sidebar')
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h3 class="font-bold text-2xl text-[#588133] leading-tight">
                {{ __('Manajemen Dashboard Real-Time') }}
            </h3>
        </div>    
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <form action="{{ route('admin.update_stats') }}" method="POST">
            @csrf 
            <div class="bg-gradient-to-br from-[#588133] to-[#99AF69] rounded-3xl p-6 text-white shadow-lg mb-8">
                <h3 class="text-xl font-bold">Manajemen Dashboard Real-time</h3>
                
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                        <p class="text-xs uppercase font-bold opacity-80">Barang Tersedia</p>
                        <input type="number" name="barang_tersedia" 
                               value="{{ $stats->barang_tersedia ?? 0 }}" 
                               min="0"
                               oninput="if(this.value < 0) this.value = 0;"
                               class="bg-transparent text-3xl font-bold opacity-80 w-full focus:outline-none border-b-2 border-white/30 focus:border-white">
                    </div>

                    <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                        <p class="text-xs uppercase font-bold opacity-80">Sedang Dipinjam</p>
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