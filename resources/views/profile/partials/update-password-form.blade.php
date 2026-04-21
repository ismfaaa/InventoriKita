<section>
    <header><h2 class="text-lg font-medium text-gray-900">Update Password</h2></header>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf @method('put')
        <div>
            <x-input-label for="current_password" value="Password Saat Ini" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="password" value="Password Baru" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" />
        </div>
        <x-primary-button>Simpan Password</x-primary-button>
    </form>
</section>