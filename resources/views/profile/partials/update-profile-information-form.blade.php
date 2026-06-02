<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Informasi Profil</h2>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- BAGIAN FOTO YANG SUDAH DIPERBAIKI --}}
        <div>
            <x-input-label for="foto" :value="__('Foto Profil')" />
            <div class="flex items-center gap-4 mt-2">
                <img src="{{ $user->foto ? asset('storage/profile-photos/'.$user->foto) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                     class="w-16 h-16 rounded-full object-cover border-2 border-[#588133]">
                <input type="file" name="foto" id="foto" accept="image/png, image/jpeg, image/jpg" 
                       class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#f1f5e9] file:text-[#588133] hover:file:bg-[#e5edda]">
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-[#588133] hover:bg-[#4a6d2b]">Simpan</x-primary-button>
            @if (session('status') === 'profile-updated') <p class="text-sm text-gray-600">Tersimpan.</p> @endif
        </div>
    </form>
</section>