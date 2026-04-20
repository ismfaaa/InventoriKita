<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-800">Daftar Akun Baru</h1>
    </div>

    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-[#588133] font-semibold" />
            <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-[#588133] focus:ring-[#588133]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                            required autocomplete="new-password"
                            placeholder="Password minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-[#588133] font-semibold" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-[#588133] focus:ring-[#588133]"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi password Anda" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-sm shadow-md">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-[#588133] hover:underline">
                Masuk di sini
            </a>
        </div>
    </form>
</x-guest-layout>