<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, harap verifikasi email Anda dengan mengeklik link yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, kami akan mengirimkan yang lain.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Link verifikasi baru telah dikirimkan ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="mt-4 flex flex-col items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf
            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full text-sm text-gray-600 hover:text-[#588133] underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#588133]">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>