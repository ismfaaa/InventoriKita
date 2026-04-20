<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Beritahu kami alamat email Anda dan kami akan mengirimkan link reset password agar Anda bisa membuat yang baru.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" autocomplete="off">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#588133] font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center py-3">
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-[#588133] underline">Kembali ke Login</a>
        </div>
    </form>
</x-guest-layout>