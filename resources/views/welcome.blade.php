<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InventoriKita - Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#f1f5e9] font-sans">
    <div class="relative flex items-center justify-center min-h-screen p-4">
        
        <div class="max-w-md w-full mx-auto p-10 text-center bg-white rounded-[40px] shadow-sm border border-white/50">
            <div class="flex justify-center mb-8">
                <x-application-logo class="h-32 w-auto object-contain" />
            </div>

            <div class="mb-10">
                <h1 class="text-4xl font-extrabold text-[#588133] tracking-tight">
                    Inventori<span class="text-[#99AF69]">Kita</span>
                </h1>
                <p class="mt-4 text-gray-600 text-sm leading-relaxed px-4">
                    Solusi modern untuk manajemen dan peminjaman inventaris dengan mudah, cepat, dan terorganisir.
                </p>
                <div class="h-1 w-16 bg-[#588133] mx-auto mt-6 rounded-full opacity-50"></div>
            </div>

            <div class="space-y-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full px-6 py-4 bg-[#588133] text-white font-bold rounded-2xl shadow-lg hover:bg-[#466629] transition-all">
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full px-6 py-4 bg-[#588133] text-white font-bold rounded-2xl shadow-lg hover:bg-[#466629] transition-all">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full px-6 py-4 bg-white text-[#588133] font-bold rounded-2xl shadow-md border-2 border-[#588133] hover:bg-[#f1f5e9] transition-all">
                                Daftar Akun
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <div class="mt-12 text-[10px] text-gray-400 uppercase tracking-widest">
                &copy; {{ date('Y') }} InventoriKita
            </div>
        </div>
    </div>
</body>
</html>