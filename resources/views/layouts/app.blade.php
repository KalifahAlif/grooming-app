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

            <!-- FOOTER UTAMA -->
            <footer class="bg-white border-t border-purple-100 py-6 mt-12 shadow-inner">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                    <div>
                        <p class="font-bold text-gray-800 flex items-center justify-center md:justify-start gap-2">
                            <span>🐾</span> 
                            <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                                Pet Grooming Service App
                            </span>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Berikan perawatan terbaik dan penuh kasih sayang untuk hewan kesayangan Anda.
                        </p>
                    </div>
                    <div class="text-xs text-gray-400 font-medium">
                        &copy; {{ date('Y') }} Pet Grooming Laravel. All rights reserved. 
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>