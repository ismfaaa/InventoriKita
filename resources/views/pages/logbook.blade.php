<x-app-layout>
    @include('layouts.sidebar')
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Digital Logbook') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm rounded-[30px] border border-[#e5edda] p-8">
            
            <div class="mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Riwayat Aktivitas</h3>
                    <p class="text-sm text-gray-500 font-medium">Seluruh aktivitas penggunaan aset secara kronologis.</p>
                </div>

                <div class="flex flex-row gap-3 items-center">

                    {{-- FITUR PENCARIAN --}}
                    <div class="relative w-56 h-[42px]">
                        <form action="{{ route('pengguna.logbook.index') }}" method="GET" class="h-full">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna atau aktivitas..." 
                                class="w-full h-full pl-9 pr-4 text-xs border border-gray-200 rounded-xl focus:ring-[#588133] focus:border-[#588133] bg-[#f1f5e9] shadow-sm transition-all" 
                                onkeydown="if(event.key === 'Enter') { this.form.submit(); return false; }">
                            @if(request('filter'))
                                <input type="hidden" name="filter" value="{{ request('filter') }}">
                            @endif
                        </form>
                    </div>

                    {{-- FITUR FILTER --}}
                    <div class="relative h-[42px]" x-data="{ open: false }">
                        <button @click="open = !open" type="button"
                            class="group h-full flex items-center gap-2 px-4 rounded-xl text-xs font-bold transition shadow-sm
                            {{ request('filter') ? 'bg-[#588133] text-white border border-[#588133] hover:bg-[#466629]' : 'bg-[#f1f5e9] text-gray-600 border border-gray-200 hover:bg-[#466629] hover:text-white' }}">
                            <svg class="w-4 h-4 shrink-0 {{ request('filter') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            <span class="hidden sm:inline">Filter Aktivitas</span>
                            @if(request('filter'))
                                <span class="flex h-2 w-2 relative ml-1">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
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
                                class="block px-4 py-3 text-xs font-medium text-gray-700 hover:bg-[#466629] hover:text-white transition">
                                Semua Aktivitas
                            </a>
                            <hr class="border-gray-50">
                            <a href="{{ route('pengguna.logbook.index', ['filter' => 'peminjaman', 'search' => request('search')]) }}"
                                class="block px-4 py-3 text-xs {{ request('filter') == 'peminjaman' ? 'bg-[#f1f5e9] text-[#588133] font-bold' : 'font-medium text-gray-700' }} hover:bg-[#466629] hover:text-white transition">
                                Peminjaman
                            </a>
                            <a href="{{ route('pengguna.logbook.index', ['filter' => 'pelaporan', 'search' => request('search')]) }}"
                                class="block px-4 py-3 text-xs {{ request('filter') == 'pelaporan' ? 'bg-[#f1f5e9] text-[#588133] font-bold' : 'font-medium text-gray-700' }} hover:bg-[#466629] hover:text-white transition">
                                Pelaporan
                            </a>
                            <a href="{{ route('pengguna.logbook.index', ['filter' => 'pengadaan', 'search' => request('search')]) }}"
                                class="block px-4 py-3 text-xs {{ request('filter') == 'pengadaan' ? 'bg-[#f1f5e9] text-[#588133] font-bold' : 'font-medium text-gray-700' }} hover:bg-[#466629] hover:text-white transition">
                                Pengadaan
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#f8faf2] text-[#588133] text-[11px] uppercase tracking-widest border-b border-[#e5edda]">
                            <th class="py-4 px-6 font-black">No</th>
                            <th class="py-4 px-6 font-black">Waktu</th>
                            <th class="py-4 px-6 font-black">Pengguna</th>
                            <th class="py-4 px-6 font-black">Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($logbook as $index => $log)
                        <tr class="hover:bg-[#fcfdfa] transition-colors group">
                            <td class="py-4 px-6 text-sm font-bold text-[#588133]/60 group-hover:text-[#588133]">{{ ($logbook->currentPage() - 1) * $logbook->perPage() + $loop->iteration }}</td>                            <td class="py-4 px-6 text-sm text-gray-500 font-medium">
                                {{ $log['waktu']->format('d M Y') }}
                                <span class="text-[10px] block opacity-50">{{ $log['waktu']->format('H:i') }} WIB</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-[#588133]/20"></div>
                                    <span class="text-sm font-bold text-gray-700">{{ $log['pengguna'] }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-sm text-gray-600 leading-relaxed">{{ $log['aktivitas'] }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-[#588133] opacity-20 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-gray-400 italic text-sm">Belum ada aktivitas tercatat hari ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Bagian Pagination --}}
            <div class="p-4 border-t border-gray-100 bg-white z-20 shrink-0">
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

                .table-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
                .table-scroll::-webkit-scrollbar-track { background: transparent; }
                .table-scroll::-webkit-scrollbar-thumb { background-color: #e2e8f0; border-radius: 8px; }
                .table-scroll::-webkit-scrollbar-thumb:hover { background-color: #cbd5e1; }
            </style>
            
        </div>
    </div>
</x-app-layout>