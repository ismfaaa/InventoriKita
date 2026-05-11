<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    
    <div class="group bg-white p-6 rounded-[30px] border border-gray-100 shadow-sm hover:shadow-xl hover:border-[#588133]/30 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex items-center gap-5">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-[#588133]/5 rounded-full blur-2xl group-hover:bg-[#588133]/15 transition-all duration-500"></div>
        
        <div class="p-4 bg-gradient-to-br from-[#f8faf2] to-[#e5edda] rounded-2xl shadow-inner text-[#588133]">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <div class="relative z-10">
            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Usulan Baru</p>                                
            <div class="flex items-baseline gap-2">
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalPending }}</h3>
                <span class="text-xs font-bold text-[#588133] bg-[#588133]/10 px-2 py-0.5 rounded-full">Item</span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-[30px] border border-gray-100 shadow-sm hover:shadow-xl hover:border-orange-500/30 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex items-center gap-5">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-500/5 rounded-full blur-2xl group-hover:bg-orange-500/15 transition-all duration-500"></div>
        
        <div class="p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl shadow-inner text-orange-500">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <div class="relative z-10">
            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Kerusakan Terverifikasi</p>
            <div class="flex items-baseline gap-2">
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalTerverifikasi }}</h3>
                <span class="text-xs font-bold text-orange-600 bg-orange-100 px-2 py-0.5 rounded-full">Laporan</span>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-[#588133] to-[#3f5e24] p-6 rounded-[30px] shadow-lg hover:shadow-xl transition-all duration-300 relative overflow-hidden flex flex-col justify-center">
        <div class="absolute -right-4 top-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute -left-10 -bottom-10 w-24 h-24 bg-black/10 rounded-full blur-xl"></div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-4 opacity-90">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <p class="text-[11px] font-black uppercase tracking-widest text-white">Urgensi Kerusakan</p>
            </div>
            
            <div class="grid grid-cols-3 gap-2 divide-x divide-white/20 text-center">
                <div class="flex flex-col">
                    <span class="text-2xl font-extrabold text-white">{{ $totalBerat }}</span>
                    <span class="text-[10px] font-bold text-red-200 uppercase mt-1">Berat</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-extrabold text-white">{{ $totalSedang }}</span>
                    <span class="text-[10px] font-bold text-orange-200 uppercase mt-1">Sedang</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-extrabold text-white">{{ $totalRingan }}</span>
                    <span class="text-[10px] font-bold text-green-200 uppercase mt-1">Ringan</span>
                </div>
            </div>
        </div>
    </div>
</div>