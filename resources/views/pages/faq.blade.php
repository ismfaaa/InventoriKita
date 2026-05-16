<x-app-layout>
    @include('layouts.sidebar')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pusat Bantuan dan FAQ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
                    <div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800 border-b pb-2">FAQ (Pertanyaan Umum)</h3>
                        <p class="text-sm text-gray-500">Informasi umum dan jawaban atas pertanyaan yang sering diajukan.</p>
                    </div>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.faq.index') }}" class="inline-flex items-center gap-2 bg-[#588133] text-white px-4 py-2 rounded-xl hover:bg-[#496b27] transition-colors">
                                Kelola FAQ
                            </a>
                        @endif
                    @endauth
                </div>

                @if($faqs->isEmpty())
                    <div class="rounded-3xl border border-dashed border-gray-300 p-8 text-center text-gray-500">
                        Belum ada FAQ tersedia. Silakan kembali lagi nanti.
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($faqs as $faq)
                            <div class="bg-gray-50 rounded-3xl border border-gray-100 p-6">
                                <h2 class="font-semibold text-lg text-gray-800">{{ $faq->question }}</h2>
                                <p class="mt-3 text-gray-600 whitespace-pre-line">{{ $faq->answer }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            @include('pages.hubungi-kami')
        </div>
        </div>
    </div>

</x-app-layout>