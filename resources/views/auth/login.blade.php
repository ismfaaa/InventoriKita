<x-guest-layout>
    <div class="mb-4">
        <h1 class="text-xl font-bold text-gray-800">Selamat Datang!</h1>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
            id="email" 
            class="block mt-1 w-full" 
            type="email" 
            name="email" 
            :value="old('email')" 
            required 
            autocomplete="one-time-code" 
            />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-[#588133] font-semibold" />

            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#588133] focus:ring-[#588133]"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#588133] shadow-sm focus:ring-[#588133]" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-[#588133] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#588133]" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-sm shadow-md">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-[#588133] hover:underline">
                Daftar di sini
            </a>
        </div>
    </form>
</x-guest-layout>