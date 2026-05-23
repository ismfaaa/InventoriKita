<x-app-layout>
    @include('layouts.sidebar')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ $documentation->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">{{ $documentation->title }}</h1>
                            <p class="text-gray-600 mt-2">{{ $documentation->description }}</p>
                        </div>
                        <a href="{{ route('documentation.index') }}" class="text-[#588133] hover:text-[#466629] font-bold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali
                        </a>
                    </div>

                    <div class="flex items-center gap-4 text-sm text-gray-500 pb-6 border-b border-gray-200">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">Versi {{ $documentation->version }}</span>
                        <span>Diperbarui: {{ $documentation->updated_at->format('d M Y H:i') }}</span>
                        @if($documentation->updated_by)
                            <span>Oleh: {{ $documentation->updated_by }}</span>
                        @endif
                    </div>
                </div>

                <div class="prose prose-sm max-w-none mb-8">
                    <div class="bg-gray-50 rounded-2xl p-8 whitespace-pre-wrap text-gray-700 leading-relaxed">
                        {{ $documentation->content }}
                    </div>
                </div>

                @if($documentation->file_name)
                    <div class="bg-blue-50 rounded-2xl border border-blue-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 3h12a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
                                    <path d="M9 11h6M9 15h4" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <div>
                                    <p class="font-bold text-blue-900">{{ $documentation->file_name }}</p>
                                    <p class="text-sm text-blue-700">File PDF - Siap untuk diunduh</p>
                                </div>
                            </div>
                            <button onclick="downloadFile('{{ route('documentation.download', $documentation) }}', '{{ $documentation->file_name }}')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition-colors">
                                Unduh Dokumen
                            </button>
                        </div>
                    </div>
                @endif
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
