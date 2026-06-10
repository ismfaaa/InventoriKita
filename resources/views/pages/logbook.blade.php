<x-app-layout>
    @include('layouts.sidebar')
    
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-[#588133] leading-tight">
                {{ __('Digital Logbook') }}
            </h2>

            <div class="flex flex-row gap-3 items-center relative z-10">
                
                {{-- FITUR PENCARIAN --}}
                <div class="relative w-64 h-[42px]">
                    <form action="{{ route('pengguna.logbook.index') }}" method="GET" class="h-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna atau aktivitas..." 
                            class="w-full h-full pl-10 pr-4 text-sm border border-gray-200 rounded-full focus:ring-2 focus:ring-[#588133] focus:outline-none bg-white shadow-sm transition-all" 
                            onkeydown="if(event.key === 'Enter') { this.form.submit(); return false; }">
                        @if(request('filter'))
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                        @endif
                    </form>
                </div>

                {{-- FITUR FILTER --}}
                <div class="relative h-[42px]" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                        class="h-full flex items-center gap-2 px-5 rounded-full text-sm font-semibold transition-all shadow-sm bg-white border border-[#588133] text-[#588133] hover:bg-[#f1f5e9]">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span class="hidden sm:inline">Filter</span>
                        @if(request('filter'))
                            <span class="flex h-2 w-2 relative ml-1">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#588133] opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#588133]"></span>
                            </span>
                        @endif
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 overflow-hidden"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-cloak>
                        <a href="{{ route('pengguna.logbook.index', ['search' => request('search')]) }}"
                            class="block px-4 py-3 text-xs font-medium text-gray-700 hover:bg-[#f1f5e9] hover:text-[#588133] transition">
                            Semua Aktivitas
                        </a>
                        <hr class="border-gray-50">
                        <a href="{{ route('pengguna.logbook.index', ['filter' => 'peminjaman', 'search' => request('search')]) }}"
                            class="block px-4 py-3 text-xs {{ request('filter') == 'peminjaman' ? 'bg-[#f1f5e9] text-[#588133] font-bold' : 'font-medium text-gray-700' }} hover:bg-[#f1f5e9] hover:text-[#588133] transition">
                            Peminjaman
                        </a>
                        <a href="{{ route('pengguna.logbook.index', ['filter' => 'pelaporan', 'search' => request('search')]) }}"
                            class="block px-4 py-3 text-xs {{ request('filter') == 'pelaporan' ? 'bg-[#f1f5e9] text-[#588133] font-bold' : 'font-medium text-gray-700' }} hover:bg-[#f1f5e9] hover:text-[#588133] transition">
                            Pelaporan
                        </a>
                        <a href="{{ route('pengguna.logbook.index', ['filter' => 'pengadaan', 'search' => request('search')]) }}"
                            class="block px-4 py-3 text-xs {{ request('filter') == 'pengadaan' ? 'bg-[#f1f5e9] text-[#588133] font-bold' : 'font-medium text-gray-700' }} hover:bg-[#f1f5e9] hover:text-[#588133] transition">
                            Pengadaan
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </x-slot>

    <div class="pt-4 pb-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        @if(request('filter'))
        <div class="mb-4">
            <span class="inline-flex items-center gap-2 bg-[#f1f5e9] text-[#588133] px-3 py-1.5 rounded-full text-xs font-bold border border-[#dce8c8]">
                Filter: {{ ucfirst(request('filter')) }}
                <a href="{{ route('pengguna.logbook.index', ['search' => request('search')]) }}" class="hover:opacity-70">✕</a>
            </span>
        </div>
        @endif

        <div class="bg-white rounded-[30px] p-5 shadow-sm border border-gray-100">
            <div class="overflow-hidden rounded-2xl border border-[#e5edda]">
                <table class="w-full text-left border-collapse">
                    
                    <thead class="bg-[#588133] text-white">
                        <tr class="text-[11px] uppercase tracking-widest border-b-0">
                            <th class="py-4 px-6 font-black whitespace-nowrap rounded-tl-2xl w-16">No</th>
                            <th class="py-4 px-6 font-black whitespace-nowrap">Waktu</th>
                            <th class="py-4 px-6 font-black whitespace-nowrap">Pengguna</th>
                            <th class="py-4 px-6 font-black whitespace-nowrap rounded-tr-2xl">Aktivitas</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($logbook as $index => $log)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 text-sm font-bold text-gray-600">
                                {{ ($logbook->currentPage() - 1) * $logbook->perPage() + $loop->iteration }}
                            </td>                            
                            
                            <td class="py-4 px-6">
                                <span class="text-sm font-bold text-gray-800 block">{{ $log['waktu']->format('d M Y') }}</span>
                                <span class="text-[11px] text-gray-400 italic">{{ $log['waktu']->format('H:i') }} WIB</span>
                            </td>
                            
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold text-gray-800">{{ $log['pengguna'] }}</span>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6">
                                <span class="text-sm text-gray-600 leading-relaxed">{{ $log['aktivitas'] }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center bg-gray-50">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm font-medium">Belum ada aktivitas tercatat.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Bagian Pagination --}}
            <div class="mt-6 shrink-0">
                <div class="pagination-matcha">
                    {{ $logbook->appends(request()->query())->links() }}
                </div>
            </div>
            
            <style>
                [x-cloak] { display: none !important; }
                
                .pagination-matcha nav a, 
                .pagination-matcha nav span[aria-disabled="true"] span {
                    background-color: white !important; 
                    color: #588133 !important; 
                    border-radius: 10px;
                    border-color: #f3f4f6 !important; 
                }

                .pagination-matcha nav a:hover {
                    background-color: #f1f5e9 !important;
                }

                .pagination-matcha nav span[aria-current="page"] span {
                    background-color: #588133 !important;
                    border-color: #588133 !important;
                    color: white !important;
                    border-radius: 10px;
                }
            </style>
            
        </div>
    </div>
</x-app-layout>