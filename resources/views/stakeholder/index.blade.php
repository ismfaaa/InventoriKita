<x-app-layout>
    
        @include('layouts.sidebar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-[#588133] mb-4">Selamat Datang, {{ auth()->user()->name }}!</h1>
                    <p class="text-gray-700">Ini adalah dashboard untuk stakeholder. Anda dapat memberikan feedback terkait pelaporan dan pengadaan aset.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>