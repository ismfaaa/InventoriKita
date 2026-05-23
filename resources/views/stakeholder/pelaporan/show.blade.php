<x-app-layout>

    @include('layouts.sidebar')

    {{-- ================= HEADER: JUDUL LAPORAN ================= --}}
    <x-slot name="header">
        <div class="px-2 sm:px-6 lg:px-8 max-w-full mx-auto flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h3 class="font-bold text-2xl text-[#588133] leading-tight shrink-0">
                {{ __('Detail Laporan Stakeholder') }}
            </h3>
            <a href="{{ route('laporan.index') }}" class="w-fit flex items-center gap-2 bg-[#f1f5e9] text-gray-600 border border-gray-200 px-4 py-2 rounded-xl text-xs font-bold hover:bg-[#466629] hover:text-white transition shadow-sm">
                ← Kembali ke List
            </a>
        </div>
    </x-slot>

    {{-- ================= KONTEN UTAMA ================= --}}
    <div class="py-8 px-2 sm:px-6 lg:px-8 max-w-full mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        @if (session('status'))
            <div class="lg:col-span-12 p-4 bg-green-50 text-[#588133] border border-green-200 rounded-2xl font-medium text-sm flex items-center gap-2" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('status') }}
            </div>
        @endif

        {{-- CARD KIRI: DETAIL LAPORAN NYA --}}
        <section class="lg:col-span-5 bg-white shadow-sm sm:rounded-3xl border border-gray-100 p-6">
            <h4 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2 border-gray-100">Informasi Laporan</h4>
            
            <div class="space-y-4">
                <div>
                    <span class="text-xs text-gray-400 block font-medium uppercase">Judul Laporan</span>
                    <p class="text-sm font-semibold text-gray-800">{{ $laporan->judul }}</p>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block font-medium uppercase">Kategori & Lokasi</span>
                    <div class="flex flex-wrap gap-2 mt-1">
                        <span class="bg-[#f1f5e9] text-[#588133] px-3 py-1 rounded-full text-[11px] font-bold border border-[#d6e4c7]">
                            {{ $laporan->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                        <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-[11px] font-bold border border-gray-200">
                            {{ $laporan->lokasi }}
                        </span>
                    </div>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block font-medium uppercase">Deskripsi Kejadian</span>
                    <p class="text-sm text-gray-700 leading-relaxed mt-1 whitespace-pre-line">{{ $laporan->deskripsi }}</p>
                </div>
            </div>
        </section>

        {{-- CARD KANAN: FEEDBACK / TANGGAPAN DENGAN PAGINATION --}}
        <section class="lg:col-span-7 bg-white shadow-sm sm:rounded-3xl border border-gray-100 flex flex-col max-h-[calc(100vh-12rem)] overflow-hidden">
            
            {{-- Header Card Feedback --}}
            <div class="p-5 border-b border-gray-50 bg-white sticky top-0 z-10 flex justify-between items-center">
                <h4 class="font-bold text-lg text-gray-800">Feedback & Tanggapan</h4>
                <span class="bg-[#588133] text-white text-xs px-2.5 py-1 rounded-lg font-bold">
                    {{ $feedbacks->total() }} Respon
                </span>
            </div>

            {{-- Area Scroll List Feedback --}}
            <div class="flex-1 overflow-y-auto table-scroll p-6 space-y-4 bg-gray-50/50">
                @forelse ($feedbacks as $feedback)
                    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-[#f1f5e9] rounded-full flex items-center justify-center text-[#588133] font-bold text-xs uppercase">
                                    {{ substr($feedback->user->name ?? 'U', 0, 2) }}
                                </div>
                                <div>
                                    <span class="text-sm font-bold text-gray-800 block leading-tight">{{ $feedback->user->name ?? 'Anonim' }}</span>
                                    <span class="text-[10px] text-gray-400 font-medium">{{ $feedback->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed pl-10">
                            {{ $feedback->isi_tanggapan }}
                        </p>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto text-gray-400 mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <p class="text-sm text-gray-400 font-medium">Belum ada feedback untuk laporan ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- FOOTER CARD: TOMBOL PAGINATION FEEDBACK --}}
            <div class="p-4 border-t border-gray-100 bg-white z-20 shrink-0">
                <div class="pagination-matcha">
                    {{-- appends(request()->query()) menjaga link pagination agar tidak merusak filter url jika ada --}}
                    {{ $feedbacks->appends(request()->query())->links() }}
                </div>
            </div>
        </section>

    </div>

    {{-- ================= STYLE TAMBAHAN (CUSTOM PAGINATION TEMAL MATCHA) ================= --}}
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

    <!-- SWEETALERT SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success') || session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{!! session('success') ?? session('status') !!}',
                    showConfirmButton: false,
                    timer: 2500
                });
            @endif
        });
    </script>
    
</x-app-layout>