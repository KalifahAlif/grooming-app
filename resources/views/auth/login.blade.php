<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-sky-100/70 via-blue-50/50 to-cyan-100/60 p-4 sm:p-6 lg:p-8">
        
        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-sky-100 grid grid-cols-1 md:grid-cols-2">
            
            <div class="relative hidden md:flex flex-col justify-between bg-gradient-to-br from-sky-500 via-blue-600 to-cyan-600 p-10 text-white overflow-hidden">
                <div class="absolute -top-10 -left-10 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-cyan-300/20 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 flex items-center gap-3">
                    <span class="p-2.5 bg-white/20 backdrop-blur-md rounded-2xl text-2xl shadow-sm">🐾</span>
                    <div>
                        <h1 class="font-extrabold text-lg tracking-wide">Pet Grooming</h1>
                        <p class="text-xs text-sky-100">Professional Care App</p>
                    </div>
                </div>

                <div class="relative z-10 my-auto py-10">
                    <span class="inline-block px-3.5 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-xs font-semibold mb-4 shadow-xs">
                        ✨ Perawatan Terbaik Anabul
                    </span>
                    <h2 class="text-3xl font-extrabold tracking-tight leading-snug">
                        Manjakan Hewan Kesayangan Anda Bersama Kami.
                    </h2>
                    <p class="text-sky-100 text-sm mt-3 leading-relaxed">
                        Masuk ke akun Anda untuk memantau status *grooming*, booking layanan spa, dan nikmati kemudahan perawatan anabul secara berkala.
                    </p>
                </div>

                <div class="relative z-10 text-xs text-sky-100">
                    © 2026 Pet Grooming Laravel. All rights reserved.
                </div>
            </div>

            <div class="p-8 sm:p-12 flex flex-col justify-center bg-white">
                <div class="mb-8">
                    <div class="md:hidden flex items-center gap-2 mb-4">
                        <span class="p-2 bg-sky-100 rounded-xl text-xl">🐾</span>
                        <span class="font-extrabold text-sky-700 text-lg">Pet Grooming App</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">Selamat Datang Kembali! 👋</h3>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1.5">
                        Silakan masukkan username dan kata sandi Anda untuk melanjutkan.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="username" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">👤</span>
                            <input id="username" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" 
                                placeholder="Masukkan username Anda"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm transition">
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-2 text-xs text-rose-500" />
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Kata Sandi</label>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">🔒</span>
                            <input id="password" type="password" name="password" required autocomplete="current-password" 
                                placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm transition">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-rose-500" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-sky-500/25 transition duration-150 flex items-center justify-center gap-2 text-sm">
                            <span>🚀</span> Masuk ke Aplikasi
                        </button>
                    </div>

                    <div class="text-center pt-4 border-t border-gray-100 mt-2">
                        <p class="text-xs text-gray-500">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="font-bold text-sky-600 hover:text-sky-800 transition">
                                Daftar sebagai Customer baru ✨
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>