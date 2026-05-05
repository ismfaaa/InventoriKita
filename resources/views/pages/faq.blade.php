<x-app-layout>
    @include('layouts.sidebar')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pusat Bantuan & FAQ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                            
                            <div class="mb-10">
                                <h3 class="text-xl font-bold mb-6 text-gray-800 border-b pb-2">FAQ (Pertanyaan Umum)</h3>
                                
                                <div class="space-y-8">
                                    
                                    <div>
                                        <h2 class="font-bold text-lg text-gray-700 mb-4 flex items-center">
                                            Prosedur Peminjaman
                                        </h2>
                                        <div class="space-y-4">
                                            <div x-data="{ open: false }" class="bg-gray-50 rounded-lg border-l-4 border-[#588133] transition-all">
                                                <button @click="open = !open" class="w-full text-left p-4 focus:outline-none">
                                                    <div class="flex justify-between items-center">
                                                        <span class="font-semibold text-[#588133]">Bagaimana cara meminjam aset?</span>
                                                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-[#588133] transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </div>
                                                </button>
                                                <div x-show="open" x-cloak class="px-4 pb-4 text-gray-600 border-t border-gray-200 pt-2 mx-4">
                                                    Pilih aset di katalog, lalu klik "Pinjam" dan isi formulir peminjaman.
                                                </div>
                                            </div>

                                            <div x-data="{ open: false }" class="bg-gray-50 rounded-lg border-l-4 border-[#588133] transition-all">
                                                <button @click="open = !open" class="w-full text-left p-4 focus:outline-none">
                                                    <div class="flex justify-between items-center">
                                                        <span class="font-semibold text-[#588133]">Kenapa status masih pending?</span>
                                                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-[#588133] transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </div>
                                                </button>
                                                <div x-show="open" x-cloak class="px-4 pb-4 text-gray-600 border-t border-gray-200 pt-2 mx-4">
                                                    Pengajuan sedang menunggu persetujuan admin (maksimal 24 jam).
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h2 class="font-bold text-lg text-gray-700 mb-4 flex items-center">
                                            Masalah Akun
                                        </h2>
                                        <div class="space-y-4">
                                            <div x-data="{ open: false }" class="bg-gray-50 rounded-lg border-l-4 border-[#588133] transition-all">
                                                <button @click="open = !open" class="w-full text-left p-4 focus:outline-none">
                                                    <div class="flex justify-between items-center">
                                                        <span class="font-semibold text-[#588133]">Saya tidak bisa login, kenapa?</span>
                                                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-[#588133] transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </div>
                                                </button>
                                                <div x-show="open" x-cloak class="px-4 pb-4 text-gray-600 border-t border-gray-200 pt-2 mx-4">
                                                    Pastikan email dan password benar. Jika lupa password, gunakan fitur reset.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h2 class="font-bold text-lg text-gray-700 mb-4 flex items-center">
                                            Pelaporan Kerusakan
                                        </h2>
                                        <div class="space-y-4">
                                            <div x-data="{ open: false }" class="bg-gray-50 rounded-lg border-l-4 border-[#588133] transition-all">
                                                <button @click="open = !open" class="w-full text-left p-4 focus:outline-none">
                                                    <div class="flex justify-between items-center">
                                                        <span class="font-semibold text-[#588133]">Bagaimana cara melaporkan kerusakan?</span>
                                                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-[#588133] transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </div>
                                                </button>
                                                <div x-show="open" x-cloak class="px-4 pb-4 text-gray-600 border-t border-gray-200 pt-2 mx-4">
                                                    Masuk ke menu laporan kerusakan, isi form dan upload foto bukti.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                @include('pages.hubungi-kami')
            </div>
        </div>
    </div>

</x-app-layout>