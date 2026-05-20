<x-app-layout>
    @include('layouts.sidebar')

    <div class="py-8 px-4 max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-[#588133]">Kelola FAQ</h1>
                <p class="text-sm text-gray-500">Tambah, edit, dan hapus pertanyaan umum untuk pengguna.</p>
            </div>
            <a href="{{ route('admin.faq.create') }}" class="inline-flex items-center gap-2 bg-[#588133] text-white px-4 py-2 rounded-xl hover:bg-[#496b27] transition-colors">
                Tambah FAQ
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-4">
            @forelse($faqs as $faq)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $faq->question }}</h2>
                            <p class="text-sm text-gray-600 mt-3 whitespace-pre-line">{{ $faq->answer }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.faq.edit', $faq) }}" class="px-4 py-2 rounded-xl bg-blue-500 text-white text-xs font-bold hover:bg-blue-600">Edit</a>
                            <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 rounded-xl bg-red-500 text-white text-xs font-bold hover:bg-red-600">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 text-gray-600">
                    Belum ada FAQ. Silakan tambahkan FAQ baru untuk ditampilkan ke pengguna.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>