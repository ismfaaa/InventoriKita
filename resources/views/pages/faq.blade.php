<x-app-layout>
    <div x-data="{ showSidebar: false }" @open-sidebar.window="showSidebar = true">
        <div x-show="showSidebar" class="fixed inset-0 z-50 flex" role="dialog">
            <div x-show="showSidebar" @click="showSidebar = false" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white shadow-xl">
                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="text-lg font-bold text-[#588133]">Menu Utama</h2>
                    <button @click="showSidebar = false" class="text-gray-500 text-2xl">&times;</button>
                </div>
                <div class="flex-1 overflow-y-auto p-4 space-y-2">
                    <a href="#" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">Form Peminjaman Baru</a>
                    <a href="#" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">Form Pengembalian Alat</a>
                    <a href="#" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">Lapor Kerusakan Alat</a>
                    <a href="{{ route('faq') }}" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">FAQ</a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-8 px-4 max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold text-[#588133] mb-6">FAQ (Pertanyaan Umum)</h1>

        <!-- KATEGORI: PEMINJAMAN -->
        <h2 class="font-semibold text-lg text-gray-700 mb-3">Prosedur Peminjaman</h2>
        <div class="space-y-3 mb-6">

            <div x-data="{ open: false }" class="border rounded-xl">
                <button @click="open = !open" class="w-full text-left px-4 py-3 font-semibold">
                    Bagaimana cara meminjam aset?
                </button>
                <div x-show="open" class="px-4 pb-3 text-sm text-gray-600">
                    Pilih aset di katalog, lalu klik "Pinjam" dan isi formulir peminjaman.
                </div>
            </div>

            <div x-data="{ open: false }" class="border rounded-xl">
                <button @click="open = !open" class="w-full text-left px-4 py-3 font-semibold">
                    Kenapa status masih pending?
                </button>
                <div x-show="open" class="px-4 pb-3 text-sm text-gray-600">
                    Pengajuan sedang menunggu persetujuan admin (maksimal 24 jam).
                </div>
            </div>

        </div>

        <!-- KATEGORI: AKUN -->
        <h2 class="font-semibold text-lg text-gray-700 mb-3">Masalah Akun</h2>
        <div class="space-y-3 mb-6">

            <div x-data="{ open: false }" class="border rounded-xl">
                <button @click="open = !open" class="w-full text-left px-4 py-3 font-semibold">
                    Saya tidak bisa login, kenapa?
                </button>
                <div x-show="open" class="px-4 pb-3 text-sm text-gray-600">
                    Pastikan email dan password benar. Jika lupa password, gunakan fitur reset.
                </div>
            </div>

        </div>

        <!-- KATEGORI: KERUSAKAN -->
        <h2 class="font-semibold text-lg text-gray-700 mb-3">Pelaporan Kerusakan</h2>
        <div class="space-y-3">

            <div x-data="{ open: false }" class="border rounded-xl">
                <button @click="open = !open" class="w-full text-left px-4 py-3 font-semibold">
                    Bagaimana cara melaporkan kerusakan?
                </button>
                <div x-show="open" class="px-4 pb-3 text-sm text-gray-600">
                    Masuk ke menu laporan kerusakan, isi form dan upload foto bukti.
                </div>
            </div>

        </div>

    </div>
</x-app-layout>