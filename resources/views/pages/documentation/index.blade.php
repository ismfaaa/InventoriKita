<x-app-layout>
    @include('layouts.sidebar')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Pusat Dokumentasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Pusat Dokumentasi InventoriKita</h3>
                    <p class="text-gray-600">Akses panduan lengkap, kebijakan, dan tata cara penggunaan sistem untuk memastikan Anda menggunakan InventoriKita dengan optimal.</p>
                </div>

                @if(session('success'))
                    <div class="mb-4 rounded-xl bg-green-50 border border-green-200 p-4 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($documentations as $doc)
                        <div class="rounded-3xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all p-6">
                            <div class="flex flex-col h-full">
                                <h3 class="text-lg font-bold text-[#588133] mb-2">{{ $doc->title }}</h3>
                                <p class="text-sm text-gray-600 mb-4 flex-grow">{{ $doc->description }}</p>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">v{{ $doc->version }}</span>
                                        <span class="text-xs text-gray-500">{{ $doc->updated_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('documentation.show', $doc) }}" class="inline-flex items-center gap-2 bg-[#588133] text-white px-4 py-2 rounded-xl hover:bg-[#466629] transition-colors text-xs font-bold">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 12a5 5 0 1110 0A5 5 0 017 12z" />
                                            </svg>
                                            Baca
                                        </a>
                                        @if($doc->file_name)
                                            <button onclick="downloadFile('{{ route('documentation.download', $doc) }}', '{{ $doc->file_name }}')" class="inline-flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-xl hover:bg-blue-600 transition-colors text-xs font-bold">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                Download
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-12">
                            <p class="text-gray-500">Belum ada dokumentasi tersedia</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadFile(url, filename) {
            const link = document.createElement('a');
            link.href = url;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Show success popup
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Dokumen "' + filename + '" telah diunduh',
                confirmButtonColor: '#588133',
                confirmButtonText: 'OK',
                timer: 3000
            });
        }
    </script>
</x-app-layout>
