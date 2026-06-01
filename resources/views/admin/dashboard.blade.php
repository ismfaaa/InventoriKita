<x-app-layout>
    @php
        $stats = \DB::table('dashboard_stats')->where('id', 1)->first() ?? (object)['barang_tersedia' => 0, 'sedang_dipinjam' => 0];
        $asets = $asets ?? []; 
    @endphp

    @include('layouts.sidebar')

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <form action="{{ route('admin.update_stats') }}" method="POST">
            @csrf 
            <div class="bg-gradient-to-br from-[#588133] to-[#99AF69] rounded-3xl p-6 text-white shadow-lg mb-8">
                <h3 class="text-xl font-bold">Manajemen Dashboard Real-time</h3>
                
                <div class="grid grid-cols-3 gap-4 mt-6">
                     <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                        <p class="text-xs uppercase font-bold opacity-80">Semua Barang</p>
                        <input type="number" name="kuantitas" 
                               value="{{ $stats->kuantitas }}" 
                               min="0"
                               oninput="if(this.value < 0) this.value = 0;"
                               class="bg-transparent text-3xl font-bold opacity-80 w-full focus:outline-none border-b-2 border-white/30 focus:border-white">
                    </div>
                    <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                        <p class="text-xs uppercase font-bold opacity-80">Barang Tersedia</p>
                        <input type="number" name="barang_tersedia" 
                               value="{{ $stats->barang_tersedia }}" 
                               min="0"
                               oninput="if(this.value < 0) this.value = 0;"
                               class="bg-transparent text-3xl font-bold opacity-80 w-full focus:outline-none border-b-2 border-white/30 focus:border-white">
                    </div>
                    <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4">
                        <p class="text-xs uppercase font-bold opacity-80">Sedang Dipinjam</p>
                        <input type="number" name="sedang_dipinjam" 
                               value="{{ $stats->sedang_dipinjam }}" 
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

        <div class="space-y-8">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="group bg-white rounded-2xl p-5 shadow-md border border-gray-100 flex justify-between items-center cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-[#99AF69]">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 mb-1">Total Aset</p>
                        <div class="flex items-baseline gap-2">
                            <h4 class="text-2xl font-bold text-slate-800">1,240</h4>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#588133] to-[#99AF69] flex items-center justify-center text-white shadow-md transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl p-5 shadow-md border border-gray-100 flex justify-between items-center cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-[#99AF69]">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 mb-1">Total Peminjaman</p>
                        <div class="flex items-baseline gap-2">
                            <h4 class="text-2xl font-bold text-slate-800">320</h4>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#588133] to-[#99AF69] flex items-center justify-center text-white shadow-md transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl p-5 shadow-md border border-gray-100 flex justify-between items-center cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-[#99AF69]">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 mb-1">Total Pelaporan</p>
                        <div class="flex items-baseline gap-2">
                            <h4 class="text-2xl font-bold text-slate-800">15</h4>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#588133] to-[#99AF69] flex items-center justify-center text-white shadow-md transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl p-5 shadow-md border border-gray-100 flex justify-between items-center cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-[#99AF69]">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 mb-1">Total Pengadaan</p>
                        <div class="flex items-baseline gap-2">
                            <h4 class="text-2xl font-bold text-slate-800">8</h4>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#588133] to-[#99AF69] flex items-center justify-center text-white shadow-md transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-md border border-gray-100 transition-all duration-300 hover:shadow-lg">
                    <h4 class="text-lg font-bold text-slate-800 mb-4">Aktivitas Harian</h4>
                    <div class="relative h-64 w-full">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 transition-all duration-300 hover:shadow-lg">
                    <h4 class="text-lg font-bold text-slate-800 mb-4">Kesehatan Aset</h4>
                    <div class="relative h-64 w-full flex justify-center">
                        <canvas id="healthChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 transition-all duration-300 hover:shadow-lg">
                    <h4 class="text-lg font-bold text-slate-800 mb-4">Tindak Lanjut Aset</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-[#588133]/10 p-4 rounded-xl border border-[#588133]/20 flex flex-col justify-between transition-all hover:bg-[#588133]/20 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-[#588133]/20 flex items-center justify-center text-[#588133] mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#588133] font-bold mb-1 uppercase tracking-wider">Laporan Pending</p>
                                <h5 class="text-2xl font-bold text-slate-800">12</h5>
                            </div>
                        </div>
                        <div class="bg-[#99AF69]/20 p-4 rounded-xl border border-[#99AF69]/30 flex flex-col justify-between transition-all hover:bg-[#99AF69]/30 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-[#99AF69]/30 flex items-center justify-center text-[#588133] mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#588133] font-bold mb-1 uppercase tracking-wider">Perlu Perbaikan</p>
                                <h5 class="text-2xl font-bold text-slate-800">5</h5>
                            </div>
                        </div>
                        <div class="bg-amber-50 p-4 rounded-xl border border-amber-100 flex flex-col justify-between transition-all hover:bg-amber-100 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-amber-200 flex items-center justify-center text-amber-600 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-amber-600 font-bold mb-1 uppercase tracking-wider">Perlu Diganti</p>
                                <h5 class="text-2xl font-bold text-slate-800">2</h5>
                            </div>
                        </div>
                        <div class="bg-red-50 p-4 rounded-xl border border-red-100 flex flex-col justify-between transition-all hover:bg-red-100 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-red-200 flex items-center justify-center text-red-600 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-red-600 font-bold mb-1 uppercase tracking-wider">Aset Hilang</p>
                                <h5 class="text-2xl font-bold text-slate-800">1</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 flex flex-col gap-6">
                    
                    <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 transition-all duration-300 hover:shadow-lg">
                        <h4 class="text-lg font-bold text-slate-800 mb-4">Feedback Peminjaman</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            
                            <div class="bg-white rounded-xl p-4 shadow-md border border-slate-200 flex justify-between items-center transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-amber-200 cursor-pointer group">
                                <div class="flex-1 min-w-0 pr-2">
                                    <p class="text-[11px] xl:text-xs font-semibold text-slate-500 mb-1 leading-snug truncate">Menunggu Approval</p>
                                    <h4 class="text-xl xl:text-2xl font-bold text-slate-800">8</h4>
                                </div>
                                <div class="w-10 h-10 shrink-0 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center transition-transform group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-4 shadow-md border border-slate-200 flex justify-between items-center transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-[#99AF69] cursor-pointer group">
                                <div class="flex-1 min-w-0 pr-2">
                                    <p class="text-[11px] xl:text-xs font-semibold text-slate-500 mb-1 leading-snug truncate">Total Disetujui</p>
                                    <h4 class="text-xl xl:text-2xl font-bold text-slate-800">145</h4>
                                </div>
                                <div class="w-10 h-10 shrink-0 rounded-xl bg-[#588133]/10 text-[#588133] flex items-center justify-center transition-transform group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-4 shadow-md border border-slate-200 flex justify-between items-center transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-red-200 cursor-pointer group">
                                <div class="flex-1 min-w-0 pr-2">
                                    <p class="text-[11px] xl:text-xs font-semibold text-slate-500 mb-1 leading-snug truncate">Total Ditolak</p>
                                    <h4 class="text-xl xl:text-2xl font-bold text-slate-800">12</h4>
                                </div>
                                <div class="w-10 h-10 shrink-0 rounded-xl bg-red-100 text-red-600 flex items-center justify-center transition-transform group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 transition-all duration-300 hover:shadow-lg">
                        <h4 class="text-lg font-bold text-slate-800 mb-4">Feedback Pengadaan</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            
                            <div class="bg-white rounded-xl p-4 shadow-md border border-slate-200 flex justify-between items-center transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-amber-200 cursor-pointer group">
                                <div class="flex-1 min-w-0 pr-2">
                                    <p class="text-[11px] xl:text-xs font-semibold text-slate-500 mb-1 leading-snug truncate">Draft / Pending</p>
                                    <h4 class="text-xl xl:text-2xl font-bold text-slate-800">3</h4>
                                </div>
                                <div class="w-10 h-10 shrink-0 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center transition-transform group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-4 shadow-md border border-slate-200 flex justify-between items-center transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-[#99AF69] cursor-pointer group">
                                <div class="flex-1 min-w-0 pr-2">
                                    <p class="text-[11px] xl:text-xs font-semibold text-slate-500 mb-1 leading-snug truncate">Total Disetujui</p>
                                    <h4 class="text-xl xl:text-2xl font-bold text-slate-800">5</h4>
                                </div>
                                <div class="w-10 h-10 shrink-0 rounded-xl bg-[#588133]/10 text-[#588133] flex items-center justify-center transition-transform group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-4 shadow-md border border-slate-200 flex justify-between items-center transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-red-200 cursor-pointer group">
                                <div class="flex-1 min-w-0 pr-2">
                                    <p class="text-[11px] xl:text-xs font-semibold text-slate-500 mb-1 leading-snug truncate">Total Ditolak</p>
                                    <h4 class="text-xl xl:text-2xl font-bold text-slate-800">0</h4>
                                </div>
                                <div class="w-10 h-10 shrink-0 rounded-xl bg-red-100 text-red-600 flex items-center justify-center transition-transform group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div> <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-md border border-gray-100 transition-all duration-300 hover:shadow-lg">
                    <h4 class="text-lg font-bold text-slate-800 mb-4">Aset Paling Sering Dipinjam</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b-2 border-gray-200 text-sm text-slate-500">
                                    <th class="py-3 px-4 font-semibold">Nama Aset</th>
                                    <th class="py-3 px-4 font-semibold">Kategori</th>
                                    <th class="py-3 px-4 font-semibold">Total Dipinjam</th>
                                    <th class="py-3 px-4 font-semibold">Status Saat Ini</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-slate-700">
                                <tr class="hover:bg-[#588133]/5 transition-colors cursor-pointer rounded-lg">
                                    <td class="py-3 px-4 font-medium rounded-l-lg">Proyektor Epson EB-X51</td>
                                    <td class="py-3 px-4 text-gray-500">Elektronik</td>
                                    <td class="py-3 px-4 font-bold text-slate-800">45 Kali</td>
                                    <td class="py-3 px-4 rounded-r-lg"><span class="bg-[#588133]/10 text-[#588133] px-3 py-1.5 rounded-full text-xs font-semibold">Tersedia</span></td>
                                </tr>
                                <tr class="hover:bg-[#588133]/5 transition-colors cursor-pointer rounded-lg">
                                    <td class="py-3 px-4 font-medium rounded-l-lg">Kabel HDMI 15 Meter</td>
                                    <td class="py-3 px-4 text-gray-500">Aksesoris</td>
                                    <td class="py-3 px-4 font-bold text-slate-800">38 Kali</td>
                                    <td class="py-3 px-4 rounded-r-lg"><span class="bg-amber-100 text-amber-700 px-3 py-1.5 rounded-full text-xs font-semibold">Dipinjam</span></td>
                                </tr>
                                <tr class="hover:bg-[#588133]/5 transition-colors cursor-pointer rounded-lg">
                                    <td class="py-3 px-4 font-medium rounded-l-lg">Kamera DSLR Canon EOS</td>
                                    <td class="py-3 px-4 text-gray-500">Elektronik</td>
                                    <td class="py-3 px-4 font-bold text-slate-800">22 Kali</td>
                                    <td class="py-3 px-4 rounded-r-lg"><span class="bg-[#588133]/10 text-[#588133] px-3 py-1.5 rounded-full text-xs font-semibold">Tersedia</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 transition-all duration-300 hover:shadow-lg">
                    <h4 class="text-lg font-bold text-slate-800 mb-4">Distribusi Peminjaman Teratas</h4>
                    <div class="relative h-56 w-full flex justify-center">
                        <canvas id="topAssetsChart"></canvas>
                    </div>
                </div>
            </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctxActivity = document.getElementById('activityChart').getContext('2d');
            new Chart(ctxActivity, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [
                        { label: 'Peminjaman', data: [12, 19, 15, 25, 22, 10, 5], borderColor: '#588133', backgroundColor: 'rgba(219, 255, 188, 0.15)', tension: 0.4, fill: true, pointBackgroundColor: '#588133' },
                        { label: 'Pelaporan', data: [2, 3, 1, 4, 2, 1, 0], borderColor: '#FDE68A', backgroundColor: 'transparent', tension: 0.4, pointBackgroundColor: '#fbbf24' },
                        { label: 'Pengadaan', data: [0, 1, 0, 0, 2, 0, 0], borderColor: '#94a3b8', backgroundColor: 'transparent', tension: 0.4, pointBackgroundColor: '#94a3b8' }
                    ]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false, 
                    plugins: { 
                        legend: { 
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        } 
                    }, 
                    interaction: { 
                        mode: 'index', 
                        intersect: false 
                    },

                    scales: {
                        x: { grid: { display: false } },
                        y: { grid: { display: false }, beginAtZero: true }
                    }
                }    
            });

            const ctxHealth = document.getElementById('healthChart').getContext('2d');
            new Chart(ctxHealth, {
                type: 'doughnut',
                data: {
                    labels: ['Sehat', 'Rusak Ringan', 'Rusak Sedang', 'Rusak Berat'],
                    datasets: [{
                        data: [850, 210, 130, 50],
                        backgroundColor: ['#588133', '#99AF69', '#FDE68A', '#F87171'],
                        borderWidth: 2, borderColor: '#ffffff', hoverOffset: 6
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, pointStyle: 'circle' } } }, cutout: '65%', layout: { padding: 10 } }
            });

            const ctxTopAssets = document.getElementById('topAssetsChart').getContext('2d');
            new Chart(ctxTopAssets, {
                type: 'doughnut',
                data: {
                    labels: ['Proyektor', 'Kabel HDMI', 'Kamera DSLR', 'Lainnya'],
                    datasets: [{
                        data: [45, 38, 22, 15],
                        backgroundColor: ['#3e5c24', '#588133', '#99AF69', '#e2e8f0'],
                        borderWidth: 2, borderColor: '#ffffff', hoverOffset: 6
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, pointStyle: 'circle' } } }, cutout: '65%', layout: { padding: 10 } }
            });
        });
    </script>
</x-app-layout>