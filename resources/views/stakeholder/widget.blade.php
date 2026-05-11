<div class="mb-4 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-black text-gray-800">Overview Inventaris</h2>
        <p class="text-sm font-medium text-gray-500">Ringkasan status pengadaan dan pelaporan saat ini</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <div class="relative bg-gradient-to-b from-[#f8faf2] to-[#e5edda] border border-[#588133]/20 rounded-[30px] p-6 flex flex-col justify-center items-center text-center shadow-sm overflow-hidden group hover:shadow-md transition-all duration-300">
        <svg class="absolute -right-4 -bottom-4 w-32 h-32 text-[#588133]/5 transform group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        
        <div class="relative z-10 w-full">
            <span class="px-4 py-1.5 bg-[#588133]/10 text-[#588133] text-[10px] font-extrabold uppercase tracking-widest rounded-full mb-4 inline-block border border-[#588133]/20">
                Usulan Pengadaan
            </span>
            <h3 class="text-7xl font-black text-[#588133] my-2 drop-shadow-sm leading-none">{{ $totalPending }}</h3>
            <div class="mt-4 bg-white/60 backdrop-blur-sm py-2 px-4 rounded-xl inline-block border border-white">
                <p class="text-xs font-bold text-[#588133]/80 uppercase tracking-wider">Menunggu Persetujuan</p>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-orange-50 to-orange-100/80 border border-orange-200/60 rounded-[30px] p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-6">
            <div>
                <span class="text-[10px] font-extrabold text-orange-600 uppercase tracking-widest bg-orange-200/50 px-3 py-1.5 rounded-lg">Pelaporan Aktif</span>
                <h3 class="text-5xl font-black text-orange-600 mt-3 leading-none">{{ $totalTerverifikasi }}</h3>
            </div>
            <div class="p-3 bg-white/80 backdrop-blur-sm rounded-2xl text-orange-500 shadow-sm border border-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        
        <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 border border-white shadow-inner">
            <p class="text-[9px] font-extrabold text-orange-800/50 uppercase tracking-widest mb-3 text-center">Breakdown Urgensi</p>
            <div class="flex justify-between items-center text-center divide-x divide-orange-200/50">
                <div class="flex-1 flex flex-col justify-center">
                    <span class="text-2xl font-black text-red-500 leading-none">{{ $totalBerat }}</span>
                    <span class="text-[9px] font-bold text-gray-500 uppercase mt-1">Berat</span>
                </div>
                <div class="flex-1 flex flex-col justify-center">
                    <span class="text-2xl font-black text-orange-500 leading-none">{{ $totalSedang }}</span>
                    <span class="text-[9px] font-bold text-gray-500 uppercase mt-1">Sedang</span>
                </div>
                <div class="flex-1 flex flex-col justify-center">
                    <span class="text-2xl font-black text-[#588133] leading-none">{{ $totalRingan }}</span>
                    <span class="text-[9px] font-bold text-gray-500 uppercase mt-1">Ringan</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-blue-50 to-blue-100/80 border border-blue-200/60 rounded-[30px] p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-6">
            <div>
                <span class="text-[10px] font-extrabold text-blue-600 uppercase tracking-widest bg-blue-200/50 px-3 py-1.5 rounded-lg">Penyelesaian</span>
                <div class="flex items-baseline gap-2 mt-3">
                    <h3 class="text-5xl font-black text-blue-600 leading-none">{{ $totalDiperbaiki + $totalDiganti }}</h3>
                    <span class="text-xs font-bold text-blue-500/70 uppercase">Total</span>
                </div>
            </div>
            <div class="p-3 bg-white/80 backdrop-blur-sm rounded-2xl text-blue-500 shadow-sm border border-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.757a1 1 0 01.707 1.707l-6.414 6.414a1 1 0 01-1.414 0L5.228 11.707a1 1 0 01.707-1.707H10V3a1 1 0 011-1h2a1 1 0 011 1v7z"/>
                </svg>
            </div>
        </div>
        
        <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 border border-white shadow-inner flex gap-2 divide-x divide-blue-200/50">
            <div class="flex-1 flex flex-col justify-center text-center">
                <span class="text-2xl font-black text-[#588133] leading-none">{{ $totalDiperbaiki }}</span>
                <span class="text-[9px] font-bold text-gray-500 uppercase mt-1 tracking-wider">Diperbaiki</span>
            </div>
            <div class="flex-1 flex flex-col justify-center text-center">
                <span class="text-2xl font-black text-blue-600 leading-none">{{ $totalDiganti }}</span>
                <span class="text-[9px] font-bold text-gray-500 uppercase mt-1 tracking-wider">Diganti Baru</span>
            </div>
        </div>
    </div>

</div>