
<x-guest-layout>
    <div
        class="min-h-screen relative flex items-center justify-center overflow-hidden bg-gradient-to-br from-sky-50 via-white to-blue-100 px-4 py-10 sm:px-6"
        x-data="{ showPassword: false }"
    >

        {{-- Background Decoration --}}
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-sky-300/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-blue-300/30 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-cyan-200/20 rounded-full blur-3xl"></div>

        {{-- Main Card --}}
        <div class="relative w-full max-w-5xl bg-white/90 backdrop-blur-xl rounded-[2rem] shadow-[0_25px_80px_-20px_rgba(14,116,144,0.25)] overflow-hidden border border-white grid grid-cols-1 md:grid-cols-2">

            {{-- LEFT PANEL --}}
<div class="relative hidden md:flex flex-col justify-between min-h-[650px] bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-12 text-white overflow-hidden">

    {{-- Decorative Circles --}}
    <div class="absolute -top-20 -right-20 w-72 h-72 border-[40px] border-white/10 rounded-full"></div>
    <div class="absolute bottom-20 -left-24 w-72 h-72 border-[35px] border-white/10 rounded-full"></div>
    <div class="absolute top-1/2 right-0 w-40 h-40 bg-cyan-300/20 rounded-full blur-3xl"></div>

    {{-- BRAND / LOGO --}}
    <div class="relative z-15 flex flex-col items-center text-center mx-auto pt-4">
        {{-- Kotak putih pembungkus kita perbesar sedikit agar lebih ideal (w-28 h-28) --}}
        <div class="w-28 h-28 flex items-center justify-center bg-white rounded-[2.25rem] shadow-2xl shadow-sky-900/25 border border-white/80 mb-4 transform transition hover:scale-105 duration-300 overflow-hidden">
            {{-- Gambar logonya kita zoom menggunakan scale-150 atau scale-175 agar ikon di dalamnya terlihat besar memenuhi kotak --}}
            <img src="{{ asset('images/logo-paw.png') }}" alt="Logo Pet Grooming" class="w-50 h-50 object-contain scale-[1.75]">
        </div>
        <h1 class="font-black text-2xl tracking-tight text-white">Pet Grooming</h1>
        <p class="text-[11px] text-sky-100 tracking-[0.25em] uppercase font-bold mt-1">Professional Care App</p>
    </div>

    {{-- Hero Content --}}
    <div class="relative z-10 my-auto py-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/15 backdrop-blur-md rounded-full text-xs font-bold tracking-wide border border-white/20 mb-6">
            <span class="w-2 h-2 bg-green-300 rounded-full animate-pulse"></span>
            PERAWATAN TERBAIK ANABUL
        </span>

        <h2 class="text-3xl lg:text-4xl font-black tracking-tight leading-[1.2]">
            Sayangi Mereka,
            <span class="block text-cyan-200 mt-1">Rawat Dengan Sepenuh Hati.</span>
        </h2>

        <p class="text-sky-100 text-sm leading-7 mt-5 max-w-sm mx-auto">
            Berikan pengalaman perawatan terbaik untuk hewan kesayangan Anda. Booking layanan grooming, pantau pesanan, dan nikmati kemudahan dalam satu aplikasi.
        </p>
    </div>

    {{-- Footer --}}
    <div class="relative z-10 border-t border-white/20 pt-6 text-center">
        <p class="text-xs text-sky-100">
            © 2026 Pet Grooming. All rights reserved.
        </p>
    </div>
</div>

            {{-- RIGHT PANEL --}}
            <div class="relative p-8 sm:p-12 lg:p-14 flex flex-col justify-center bg-white">

                {{-- Mobile Brand --}}
                <div class="md:hidden flex items-center gap-3 mb-10">
                    <div class="w-12 h-12 bg-sky-100 rounded-2xl flex items-center justify-center text-2xl">
                        🐾
                    </div>
                    <div>
                        <h1 class="font-extrabold text-sky-700 text-lg">Pet Grooming</h1>
                        <p class="text-[10px] text-gray-400 tracking-widest uppercase">Professional Care App</p>
                    </div>
                </div>

                {{-- Heading --}}
                <div class="mb-9">
                    <div class="inline-flex items-center gap-2 text-sky-600 text-xs font-bold uppercase tracking-widest mb-4">
                        <span class="w-8 h-[2px] bg-sky-500"></span>
                        Welcome Back
                    </div>

                    <h3 class="text-3xl font-black text-gray-900 tracking-tight">
                        Selamat Datang!
                    </h3>

                    <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                        Silakan masuk menggunakan akun Anda untuk melanjutkan ke aplikasi Pet Grooming.
                    </p>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-5" :status="session('status')" />

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-sm font-bold text-gray-700 mb-2">
                            Username
                        </label>

                        <div class="relative group">
                            {{-- User Icon --}}
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-sky-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21a8 8 0 0 0-16 0"></path>
                                    <circle cx="12" cy="8" r="4"></circle>
                                </svg>
                            </span>

                            <input
                                id="username"
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Masukkan username Anda"
                                class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 bg-gray-50 text-sm text-gray-800 placeholder-gray-400 outline-none transition duration-300 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 hover:border-sky-300"
                            >
                        </div>

                        <x-input-error :messages="$errors->get('username')" class="mt-2 text-xs text-rose-500" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                            Kata Sandi
                        </label>

                        <div class="relative group">
                            {{-- Lock Icon --}}
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-sky-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>

                            <input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan kata sandi"
                                class="w-full pl-12 pr-14 py-4 rounded-2xl border border-gray-200 bg-gray-50 text-sm text-gray-800 placeholder-gray-400 outline-none transition duration-300 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 hover:border-sky-300"
                            >

                            {{-- Eye Button --}}
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-sky-600 transition"
                                aria-label="Tampilkan atau sembunyikan kata sandi"
                            >
                                {{-- Eye Open --}}
                                <svg
                                    x-show="!showPassword"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="21" height="21"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>

                                {{-- Eye Closed --}}
                                <svg
                                    x-show="showPassword"
                                    x-cloak
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="21" height="21"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="m3 3 18 18"></path>
                                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                                    <path d="M9.9 5.2A10.5 10.5 0 0 1 12 5c6.5 0 10 7 10 7a15.8 15.8 0 0 1-3 3.8"></path>
                                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.5 7 10 7c1.3 0 2.5-.3 3.6-.8"></path>
                                </svg>
                            </button>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-rose-500" />
                    </div>

                    {{-- Login Button --}}
                    <div class="pt-2">
                        <button
                            type="submit"
                            class="group relative w-full overflow-hidden bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-600 hover:from-sky-600 hover:via-blue-700 hover:to-indigo-700 text-white font-bold py-4 px-5 rounded-2xl shadow-lg shadow-blue-500/25 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/30 hover:-translate-y-1 active:translate-y-0 active:scale-[0.98]"
                        >
                            <span class="relative z-10 flex items-center justify-center gap-3">
                                Masuk ke Aplikasi
                                <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                            </span>
                        </button>
                    </div>

                    {{-- Register --}}
                    <div class="relative flex items-center gap-4 pt-5">
                        <div class="flex-1 h-px bg-gray-100"></div>
                        <span class="text-xs text-gray-400">Belum bergabung?</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>

                    <div class="text-center">
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 text-sm font-bold text-sky-600 hover:text-blue-700 transition-colors duration-200"
                        >
                            Buat Akun Sekarang
                            <span class="transition-transform duration-200 hover:translate-x-1">→</span>
                        </a>
                    </div>
                </form>

                {{-- Bottom Note --}}
                <div class="mt-10 flex items-center justify-center gap-2 text-[11px] text-gray-400">
                    <span></span>
                    <span>Secure Login · Pet Grooming Management System</span>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
