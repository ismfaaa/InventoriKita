<x-app-layout>
    @include('layouts.sidebar')
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Digital Logbook') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm rounded-[30px] border border-[#e5edda] p-8">
            
            <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Riwayat Aktivitas</h3>
                    <p class="text-sm text-gray-500 font-medium">Seluruh aktivitas penggunaan aset secara kronologis.</p>
                </div>
                <div class="h-1 w-12 bg-[#588133] opacity-20 rounded-full"></div>
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
                            <td class="py-4 px-6 text-sm font-bold text-[#588133]/60 group-hover:text-[#588133]">{{ $index + 1 }}</td>
                            <td class="py-4 px-6 text-sm text-gray-500 font-medium">
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