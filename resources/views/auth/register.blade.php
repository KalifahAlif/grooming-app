<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-sky-100/70 via-blue-50/50 to-cyan-100/60 p-4 sm:p-6 lg:p-8" 
         x-data="{ showPassword: false, showConfirmPassword: false }">
        
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
                        ✨ Bergabung Bersama Kami
                    </span>
                    <h2 class="text-3xl font-extrabold tracking-tight leading-snug">
                        Berikan Perawatan Terbaik Untuk Anabul Kesayangan.
                    </h2>
                    <p class="text-sky-100 text-sm mt-3 leading-relaxed">
                        Buat akun baru sekarang untuk mulai memesan jadwal *grooming*, spa, dan penjemputan hewan peliharaan dengan mudah.
                    </p>
                </div>

                <div class="relative z-10 text-xs text-sky-100">
                    © 2026 Pet Grooming Laravel. All rights reserved.
                </div>
            </div>

            <div class="p-8 sm:p-12 flex flex-col justify-center bg-white">
                <div class="mb-6">
                    <div class="md:hidden flex items-center gap-2 mb-4">
                        <span class="p-2 bg-sky-100 rounded-xl text-xl">🐾</span>
                        <span class="font-extrabold text-sky-700 text-lg">Pet Grooming App</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru ✨</h3>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Lengkapi data diri Anda untuk mendaftar.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                            placeholder="Nama Anda"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm transition">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-rose-500" />
                    </div>

                    <div>
                        <label for="username" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Username (Untuk Login)</label>
                        <input id="username" type="text" name="username" :value="old('username')" required autocomplete="username" 
                            placeholder="Buat username unik"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm transition">
                        <x-input-error :messages="$errors->get('username')" class="mt-1 text-xs text-rose-500" />
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Alamat Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="email" 
                            placeholder="nama@email.com"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm transition">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-500" />
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Kata Sandi</label>
                        <div class="relative">
                            <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="new-password" 
                                placeholder="••••••••"
                                class="w-full pl-4 pr-12 py-2.5 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm transition">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-sky-600 focus:outline-none transition">
                                <span x-text="showPassword ? '👁️‍🗨️' : '👁️'" class="text-base"></span>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-500" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input id="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" 
                                placeholder="••••••••"
                                class="w-full pl-4 pr-12 py-2.5 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm transition">
                            <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-sky-600 focus:outline-none transition">
                                <span x-text="showConfirmPassword ? '👁️‍🗨️' : '👁️'" class="text-base"></span>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-rose-500" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-sky-500/25 transition duration-150 flex items-center justify-center gap-2 text-sm">
                            <span>✨</span> Daftar Sekarang
                        </button>
                    </div>

                    <div class="text-center pt-2">
                        <p class="text-xs text-gray-500">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="font-bold text-sky-600 hover:text-sky-800 transition">Masuk di sini 🚀</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>