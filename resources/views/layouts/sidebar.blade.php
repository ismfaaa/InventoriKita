@if (auth()->check())

    @if (auth()->user()->role === 'pengguna')
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
                </div>
            </div>
        </div>
    </div>
    
    @elseif (auth()->user()->role === 'admin')
    <div>
        <div x-data="{ showSidebar: false }" @open-sidebar.window="showSidebar = true">
            <div x-show="showSidebar" class="fixed inset-0 z-50 flex" role="dialog">
                <div x-show="showSidebar" @click="showSidebar = false" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
                <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white shadow-xl">
                    <div class="p-6 border-b flex justify-between items-center">
                        <h2 class="text-lg font-bold text-[#588133]">Menu Utama</h2>
                        <button @click="showSidebar = false" class="text-gray-500 text-2xl">&times;</button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-4 space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">Dashboard</a>
                        <a href="{{ route('inventaris.index') }}" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">Manajemen Inventaris</a>
                        <a href="{{ route('peminjaman.index') }}" class="block p-3 rounded-xl hover:bg-[#f1f5e9] text-gray-700 font-medium">Manajemen Peminjaman</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @elseif (auth()->user()->role === 'stakeholder')
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
                </div>
            </div>
        </div>
    </div>

    @endif

@endif