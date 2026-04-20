<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'InventoriKita') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#f8faf2]">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white shadow-sm border-b border-[#e5edda]">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-grow pb-10"> 
                {{ $slot }}
            </main>

            <footer class="py-12 text-center bg-transparent">
                <div class="h-[1px] w-16 bg-[#588133] mx-auto mb-6 rounded-full opacity-20"></div>
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-medium">
                    &copy; {{ date('Y') }} InventoriKita.
                </p>
            </footer>
        </div>
    </body>
</html>