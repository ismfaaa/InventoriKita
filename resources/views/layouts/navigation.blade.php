<nav x-data="{ open: false }" class="bg-white border-b border-[#e5edda] relative z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex items-center">
                <button @click="$dispatch('open-sidebar')" class="inline-flex items-center justify-center p-2 rounded-md text-[#588133] hover:bg-[#f1f5e9] focus:outline-none transition mr-4">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="shrink-0 flex items-center gap-3">
                    @php
                        // menentukan route home berdasarkan role user yang sedang login
                        $homeRoute = match(auth()->user()->role) {
                            'admin' => 'admin.dashboard',
                            'stakeholder' => 'stakeholder.index',
                            default => 'pengguna.index',
                        };
                    @endphp

                    <a href="{{ route($homeRoute) }}" class="flex items-center gap-2">
                        <span class="font-bold text-xl text-[#588133] tracking-tight">
                            Inventori<span class="text-[#99AF69]">Kita</span>
                        </span>
                        <x-application-logo class="block h-8 w-auto" />
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border-b border-[#e5edda]-300 text-sm leading-4 font-medium rounded-full text-gray-700 bg-white-50 hover:text-[#588133] hover:bg-white focus:outline-none transition ease-in-out duration-150 shadow-sm">
            
                            <div class="flex-shrink-0 w-8 h-8 mr-2.5">
                                @if(Auth::user()->foto)
                                    <img src="{{ asset('storage/profile-photos/' . Auth::user()->foto) }}" 
                                        class="w-full h-full rounded-full object-cover border-b border-[#e5edda]-300"
                                        alt="Profile">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=002d72&color=e5edda" 
                                        class="w-full h-full rounded-full object-cover"
                                        alt="Avatar">
                                @endif
                            </div>
                            
                            <span class="font-semibold truncate max-w-[120px]">{{ Auth::user()->name }}</span>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                        </button>
                          
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>