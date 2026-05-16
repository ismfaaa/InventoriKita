<x-app-layout>
    <div class="py-8 px-4 max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#588133]">Tambah FAQ Baru</h1>
            <p class="text-sm text-gray-500">Tulis pertanyaan dan jawaban yang akan dilihat pengguna.</p>
        </div>

        @if($errors->any())
            <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4 text-red-700">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.faq.store') }}" method="POST" class="space-y-5 bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pertanyaan</label>
                <input type="text" name="question" value="{{ old('question') }}" class="w-full rounded-2xl border border-gray-200 px-4 py-3 focus:border-[#588133] focus:ring-[#588133]/20" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jawaban</label>
                <textarea name="answer" rows="5" class="w-full rounded-2xl border border-gray-200 px-4 py-3 focus:border-[#588133] focus:ring-[#588133]/20" required>{{ old('answer') }}</textarea>
            </div>
            <div class="flex gap-3 items-center">
                <a href="{{ route('admin.faq.index') }}" class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-xl bg-[#588133] text-white hover:bg-[#496b27]">Simpan FAQ</button>
            </div>
        </form>
    </div>
</x-app-layout>