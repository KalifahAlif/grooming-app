<nav x-data="{ open: false }" class="bg-white border-b border-sky-100 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo / Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <span class="p-2 bg-sky-100 rounded-xl text-xl shadow-xs">🐾</span>
                        <span class="font-extrabold text-sky-700 tracking-tight text-base">Pet Grooming</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex items-center">
                    @if(request()->routeIs('dashboard'))
                        <button onclick="document.getElementById('paket-layanan').scrollIntoView({ behavior: 'smooth' })" class="inline-flex items-center px-1 pt-1 text-xs font-bold uppercase tracking-wider text-gray-600 hover:text-sky-600 transition cursor-pointer">
                            Booking
                        </button>

                        <button onclick="document.getElementById('riwayat-pesanan').scrollIntoView({ behavior: 'smooth' })" class="inline-flex items-center px-1 pt-1 text-xs font-bold uppercase tracking-wider text-gray-600 hover:text-sky-600 transition cursor-pointer">
                            Pesanan Saya
                        </button>
                    @endif
                    
                    @if(Auth::user()->usertype == 'admin' || Auth::user()->username == 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-xs font-bold uppercase tracking-wider text-sky-600">
                            {{ __('Admin Panel') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-bold rounded-xl text-gray-700 bg-sky-50 hover:bg-sky-100 focus:outline-none transition">
                            <div>👤 {{ Auth::user()->name ?? Auth::user()->username }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profil Akun') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Keluar (Logout)') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>