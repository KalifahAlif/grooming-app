<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 flex flex-col min-h-screen">
        <div class="min-h-screen bg-gray-100 flex flex-col justify-between">
            <div>
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow-sm">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="mb-auto">
                    {{ $slot }}
                </main>
            </div>

            
            <!-- Footer Minimalis Bernuansa Biru -->
    <footer class="bg-white border-t border-sky-100 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2">
            <div class="flex items-center justify-center gap-2">
                <span class="p-1.5 bg-sky-100 rounded-lg text-sm">🐾</span>
                <span class="font-extrabold text-sky-700 text-sm">Pet Grooming Service App</span>
            </div>
            <p class="text-xs text-gray-500">
                Berikan perawatan terbaik dan penuh kasih sayang untuk hewan kesayangan Anda.
            </p>
            <p class="text-[11px] text-gray-400 pt-2">
                © 2026 Pet Grooming Laravel. All rights reserved.
            </p>
        </div>
    </footer>
        </div>
    </body>
</html>