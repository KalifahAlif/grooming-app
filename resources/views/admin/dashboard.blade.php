<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-white border border-sky-100 flex items-center justify-center shadow-lg shadow-sky-500/15 overflow-hidden">
                    <img src="{{ asset('images/logo-paw.png') }}" alt="Logo Pet Grooming" class="w-full h-full object-contain scale-[1.65]">
                </div>
                <div>
                    <h2 class="font-extrabold text-xl sm:text-2xl text-gray-800 tracking-tight">
                        Admin Dashboard
                    </h2>
                    <p class="text-xs text-gray-400 mt-0.5">Pet Grooming Management System</p>
                </div>
            </div>

            <span class="inline-flex items-center gap-2 text-xs font-bold bg-sky-50 text-sky-700 border border-sky-100 px-4 py-2 rounded-xl">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Administrator Access
            </span>
        </div>
    </x-slot>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeIn {
            animation: fadeIn .6s ease-out forwards;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    <div
        class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-blue-50 py-8 sm:py-10 animate-fadeIn"
        x-data="{
            modalOpen: false,
            selectedBooking: {},
            editModalOpen: false,
            editService: {
                id: '',
                name: '',
                description: '',
                price: '',
                duration: ''
            }
        }"
    >

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-9">

            {{-- HERO BANNER --}}
            <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-7 sm:p-10 lg:p-12 shadow-xl shadow-blue-500/15">

                <div class="absolute -top-24 -right-16 w-80 h-80 rounded-full border-[45px] border-white/10"></div>
                <div class="absolute -bottom-28 left-1/3 w-72 h-72 rounded-full bg-cyan-300/20 blur-3xl"></div>
                <div class="absolute top-10 right-1/3 w-24 h-24 rounded-full bg-white/10 blur-2xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-white max-w-2xl">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/15 border border-white/20 px-4 py-2 text-xs font-bold tracking-wide backdrop-blur-md mb-6">
                            <span class="w-2 h-2 bg-emerald-300 rounded-full animate-pulse"></span>
                            PUSAT KONTROL ADMINISTRATOR
                        </span>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight tracking-tight">
                            Halo, Admin {{ Auth::user()->name }}!
                            <span class="block text-cyan-200 mt-2">Selamat Bekerja.</span>
                        </h1>

                        <p class="mt-5 text-sm sm:text-base text-sky-100 leading-7 max-w-xl">
                            Kelola paket layanan grooming, pantau pesanan customer,
                            dan atur proses pelayanan melalui dashboard administrator.
                        </p>

                        <div class="flex flex-wrap gap-3 mt-8">
                            <a href="#tambah-layanan"
                               class="inline-flex items-center gap-2 bg-white text-blue-700 hover:bg-sky-50 px-5 py-3 rounded-xl font-extrabold text-sm shadow-lg transition hover:-translate-y-1">
                                <span>＋</span>
                                Tambah Layanan
                            </a>

                            <a href="#pesanan-masuk"
                               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/30 text-white px-5 py-3 rounded-xl font-bold text-sm backdrop-blur-md transition">
                                <span>📋</span>
                                Lihat Pesanan
                            </a>
                        </div>
                    </div>

                    <div class="hidden md:flex relative flex-shrink-0">
                        <div class="w-52 h-52 lg:w-60 lg:h-60 rounded-full bg-white/10 border border-white/20 backdrop-blur-md flex items-center justify-center shadow-2xl overflow-hidden p-8">
                            <div class="w-full h-full flex items-center justify-center transition duration-500 hover:scale-110 hover:rotate-6">
                                <img src="{{ asset('images/logo-paw.png') }}" alt="Logo Pet Grooming" class="w-full h-full object-contain drop-shadow-2xl scale-[1.85]">
                            </div>
                        </div>
                        <div class="absolute -top-3 -right-3 bg-white rounded-2xl p-2.5 shadow-xl rotate-6 w-12 h-12 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('images/logo-paw.png') }}" alt="Logo Pet Grooming" class="w-full h-full object-contain scale-[1.65]">
                        </div>
                        <div class="absolute -bottom-2 -left-4 w-14 h-14 bg-white rounded-2xl shadow-xl -rotate-6 flex items-center justify-center overflow-hidden p-1.5">
                            <img src="{{ asset('images/logo-paw.png') }}" alt="Logo Pet Grooming" class="w-full h-full object-contain scale-[1.65]">
                        </div>
                    </div>
                </div>
            </section>

            {{-- SUCCESS NOTIFICATION --}}
            @if(session('success'))
                <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 rounded-2xl px-5 py-4 text-emerald-800 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-xl">
                        ✓
                    </div>
                    <div>
                        <p class="font-bold text-sm">Berhasil!</p>
                        <p class="text-xs mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- STATISTIK --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                <div class="bg-white rounded-3xl p-6 border border-sky-100 shadow-sm hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Layanan</p>
                            <h3 class="text-3xl font-black text-gray-900 mt-2">
                                {{ collect($services ?? [])->count() }}
                            </h3>
                            <p class="text-xs text-sky-600 font-semibold mt-2">Paket Grooming</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-white border border-sky-100 shadow-sm flex items-center justify-center overflow-hidden p-2">
                            <img src="{{ asset('images/logo-paw.png') }}" alt="Logo Total Layanan" class="w-full h-full object-contain scale-[1.65]">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-blue-100 shadow-sm hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pesanan</p>
                            <h3 class="text-3xl font-black text-gray-900 mt-2">
                                {{ collect($bookings ?? [])->count() }}
                            </h3>
                            <p class="text-xs text-blue-600 font-semibold mt-2">Semua Pesanan</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">
                            📋
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-amber-100 shadow-sm hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menunggu</p>
                            <h3 class="text-3xl font-black text-gray-900 mt-2">
                                {{ collect($bookings ?? [])->where('status', 'pending')->count() }}
                            </h3>
                            <p class="text-xs text-amber-600 font-semibold mt-2">Perlu Diproses</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center text-3xl">
                            ⏳
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-emerald-100 shadow-sm hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Selesai</p>
                            <h3 class="text-3xl font-black text-gray-900 mt-2">
                                {{ collect($bookings ?? [])->where('status', 'completed')->count() }}
                            </h3>
                            <p class="text-xs text-emerald-600 font-semibold mt-2">Pesanan Selesai</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-3xl">
                            🎉
                        </div>
                    </div>
                </div>

            </section>

            {{-- FORM TAMBAH + DAFTAR LAYANAN --}}
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- TAMBAH LAYANAN --}}
                <div id="tambah-layanan" class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-sky-100 scroll-mt-24">

                    <div class="flex items-center gap-3 border-b border-gray-100 pb-5 mb-6">
                        <div class="w-11 h-11 rounded-xl bg-white border border-sky-100 shadow-sm flex items-center justify-center overflow-hidden p-1.5">
                            <img src="{{ asset('images/logo-paw.png') }}" alt="Logo Tambah Layanan" class="w-full h-full object-contain scale-[1.65]">
                        </div>
                        <div>
                            <h3 class="font-extrabold text-gray-900">Tambah Layanan</h3>
                            <p class="text-xs text-gray-400 mt-1">Buat paket grooming baru</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                                Nama Layanan
                            </label>
                            <input
                                type="text"
                                name="name"
                                placeholder="Contoh: Full Grooming Spa"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                                Deskripsi
                            </label>
                            <textarea
                                name="description"
                                rows="3"
                                placeholder="Jelaskan fasilitas yang didapat..."
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition resize-none"
                                required
                            ></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                                Harga (Rp)
                            </label>
                            <input
                                type="number"
                                name="price"
                                min="0"
                                placeholder="75000"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                                Durasi
                            </label>
                            <input
                                type="text"
                                name="duration"
                                placeholder="45 Menit"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                            >
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-extrabold py-3.5 rounded-xl shadow-lg shadow-sky-500/20 transition hover:-translate-y-0.5 flex items-center justify-center gap-2"
                        >
                             Simpan Layanan
                        </button>
                    </form>
                </div>

                {{-- DAFTAR LAYANAN --}}
                <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-sky-100">

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-100 pb-5 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center text-xl">
                                📦
                            </div>
                            <div>
                                <h3 class="font-extrabold text-gray-900">Daftar Paket Layanan</h3>
                                <p class="text-xs text-gray-400 mt-1">Kelola paket grooming yang tersedia</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-sky-700 bg-sky-50 border border-sky-100 px-3 py-2 rounded-xl">
                            {{ collect($services ?? [])->count() }} Layanan
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-h-[620px] overflow-y-auto pr-1">

                        @forelse($services ?? [] as $service)
                            <div class="group bg-white rounded-3xl border border-sky-100 shadow-sm hover:shadow-xl hover:shadow-sky-500/10 hover:border-sky-300 transition-all duration-300 overflow-hidden flex flex-col justify-between">

                                {{-- Garis gradasi di atas kartu (menyamai dashboard customer) --}}
                                <div class="h-2 bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-500"></div>

                                <div class="p-6 flex flex-col flex-1">
                                    <div class="flex justify-between items-center mb-5">
                                        <div class="w-14 h-14 rounded-2xl bg-white border border-sky-100 shadow-sm flex items-center justify-center group-hover:scale-110 transition overflow-hidden p-1.5">
                                            <img src="{{ asset('images/logo-paw.png') }}" alt="Logo Paket Layanan" class="w-full h-full object-contain scale-[1.65]">
                                        </div>

                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-sky-700 bg-sky-50 border border-sky-100 px-3 py-2 rounded-xl">
                                            ⏱️ {{ $service->duration ?? '30 Menit' }}
                                        </span>
                                    </div>

                                    <h4 class="font-extrabold text-lg text-gray-900 group-hover:text-sky-700 transition">
                                        {{ $service->title }}
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-3 leading-6 flex-1">
                                        {{ $service->description }}
                                    </p>

                                    <div class="mt-6 pt-5 border-t border-gray-100">
                                        <p class="text-[10px] font-extrabold uppercase tracking-widest text-gray-400">
                                            Harga Mulai Dari
                                        </p>

                                        <div class="flex items-center justify-between gap-3 mt-1">
                                            <div>
                                                <span class="text-xl font-black text-sky-700">
                                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                                </span>
                                            </div>

                                            <div class="flex items-center gap-2">
                                                <button
                                                    type="button"
                                                    @click="
                                                        editModalOpen = true;
                                                        editService.id = {{ $service->id }};
                                                        editService.name = {{ Illuminate\Support\Js::from($service->title) }};
                                                        editService.description = {{ Illuminate\Support\Js::from($service->description) }};
                                                        editService.price = {{ Illuminate\Support\Js::from((string) $service->price) }};
                                                        editService.duration = {{ Illuminate\Support\Js::from($service->duration ?? '') }};
                                                    "
                                                    class="inline-flex items-center gap-1 bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 text-xs font-extrabold px-3.5 py-2.5 rounded-xl transition"
                                                >
                                                    ✏️ Edit
                                                </button>

                                                <form
                                                    action="{{ route('admin.services.destroy', $service->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus paket layanan ini?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center justify-center bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 text-xs font-extrabold p-2.5 rounded-xl transition"
                                                        title="Hapus Layanan"
                                                    >
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-dashed border-sky-200">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white border border-sky-100 shadow-sm flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('images/logo-paw.png') }}" alt="Logo Kosong" class="w-full h-full object-contain scale-[1.65]">
                                </div>
                                <h4 class="font-bold text-gray-700">Belum Ada Paket Layanan</h4>
                                <p class="text-sm text-gray-400 mt-2">
                                    Paket grooming belum tersedia saat ini.
                                </p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </section>

            {{-- PESANAN MASUK --}}
            <section id="pesanan-masuk" class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-sky-100 scroll-mt-24">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-100 pb-5 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-cyan-100 flex items-center justify-center text-xl">
                            📥
                        </div>
                        <div>
                            <h3 class="font-extrabold text-gray-900 text-lg">Pesanan Masuk Customer</h3>
                            <p class="text-xs text-gray-400 mt-1">Kelola dan perbarui status pesanan</p>
                        </div>
                    </div>

                    <span class="text-xs font-bold text-cyan-700 bg-cyan-50 border border-cyan-100 px-4 py-2 rounded-xl">
                        {{ collect($bookings ?? [])->count() }} Pesanan
                    </span>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-gray-100">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-sky-50 to-blue-50 border-b border-sky-100">
                                <th class="px-6 py-4 text-left text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-4 text-left text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Layanan & Hewan</th>
                                <th class="px-6 py-4 text-left text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Jadwal</th>
                                <th class="px-6 py-4 text-center text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Status & Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($bookings ?? [] as $booking)
                                <tr class="hover:bg-sky-50/40 transition">

                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-extrabold text-sm">
                                                {{ strtoupper(substr($booking->customer_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900 text-sm">
                                                    {{ $booking->customer_name }}
                                                </p>
                                                <p class="text-xs text-gray-400 mt-1">
                                                    {{ $booking->phone }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <p class="font-bold text-sky-700 text-sm">
                                            {{ $booking->service->title ?? 'Layanan' }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1.5">
                                            <span class="w-4 h-4 rounded-sm bg-white border border-sky-100 inline-flex items-center justify-center overflow-hidden flex-shrink-0">
                                                <img src="{{ asset('images/logo-paw.png') }}" alt="Ikon Hewan" class="w-full h-full object-contain scale-[1.65]">
                                            </span>
                                            {{ $booking->pet_type }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-5 whitespace-nowrap text-xs text-gray-500">
                                        📅 {{ \Carbon\Carbon::parse($booking->booking_time)->format('d M Y') }}
                                        <p class="mt-1 font-bold text-gray-700">
                                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB
                                        </p>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="flex flex-col sm:flex-row items-center justify-center gap-2">

                                            <button
                                                type="button"
                                                @click="
                                                    modalOpen = true;
                                                    selectedBooking = {{ Illuminate\Support\Js::from([
                                                        'customer_name' => $booking->customer_name,
                                                        'customer_email' => $booking->customer_email ?? '-',
                                                        'phone' => $booking->phone,
                                                        'service_title' => $booking->service->title ?? 'Layanan',
                                                        'pet_type' => $booking->pet_type,
                                                        'booking_time' => \Carbon\Carbon::parse($booking->booking_time)->format('d M Y, H:i'),
                                                        'address' => $booking->address,
                                                        'status' => $booking->status
                                                    ]) }};
                                                "
                                                class="px-3 py-2 bg-sky-50 hover:bg-sky-100 text-sky-700 text-xs font-bold rounded-lg border border-sky-200 transition"
                                            >
                                                🔍 Detail
                                            </button>

                                            <form
                                                action="{{ route('admin.bookings.update', $booking->id) }}"
                                                method="POST"
                                                class="inline-flex"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <select
                                                    name="status"
                                                    onchange="this.form.submit()"
                                                    class="text-xs font-bold rounded-lg border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-100 py-2 pl-2 pr-7"
                                                >
                                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                                    <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>✅ Disetujui</option>
                                                    <option value="picked_up" {{ $booking->status == 'picked_up' ? 'selected' : '' }}>🚗 Dijemput</option>
                                                    <option value="grooming" {{ $booking->status == 'grooming' ? 'selected' : '' }}>🛁 Grooming</option>
                                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>🎉 Selesai</option>
                                                    <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
                                                </select>
                                            </form>

                                            <form
                                                action="{{ route('admin.bookings.destroy', $booking->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus riwayat pesanan ini?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="px-3 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-lg border border-rose-200 transition"
                                                    title="Hapus Pesanan"
                                                >
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="text-4xl mb-3">📭</div>
                                        <p class="font-bold text-gray-700">Belum Ada Pesanan</p>
                                        <p class="text-xs text-gray-400 mt-1">Pesanan customer akan muncul di sini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        {{-- MODAL DETAIL PESANAN --}}
        <div
            x-show="modalOpen"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 overflow-y-auto bg-gray-950/60 backdrop-blur-sm flex items-center justify-center p-4"
        >
            <div
                @click.away="modalOpen = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                class="bg-white rounded-[2rem] max-w-lg w-full shadow-2xl overflow-hidden"
            >
                <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-6 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-xs text-sky-100 font-bold uppercase tracking-widest">Booking Information</span>
                            <h3 class="font-black text-xl mt-1">Detail Pesanan</h3>
                        </div>
                        <button @click="modalOpen = false" class="w-9 h-9 rounded-xl bg-white/15 hover:bg-white/25 text-2xl transition">
                            &times;
                        </button>
                    </div>
                </div>

                <div class="p-6 space-y-4 text-sm">

                    <div class="bg-sky-50 p-4 rounded-2xl border border-sky-100">
                        <p class="text-[10px] font-extrabold text-sky-700 uppercase tracking-widest mb-3">Informasi Customer</p>
                        <p class="font-extrabold text-gray-900" x-text="selectedBooking.customer_name"></p>
                        <p class="text-xs text-gray-500 mt-2" x-text="'Email: ' + selectedBooking.customer_email"></p>
                        <p class="text-xs text-gray-500 mt-1" x-text="'Telepon: ' + selectedBooking.phone"></p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <p class="text-[10px] font-extrabold text-gray-500 uppercase tracking-widest mb-3">Layanan & Hewan</p>
                        <p class="font-extrabold text-sky-700" x-text="selectedBooking.service_title"></p>
                        <p class="text-xs text-gray-600 mt-2" x-text="'Jenis Hewan: ' + selectedBooking.pet_type"></p>
                        <p class="text-xs text-gray-600 mt-1" x-text="'Jadwal: ' + selectedBooking.booking_time"></p>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-2xl border border-blue-100">
                        <p class="text-[10px] font-extrabold text-blue-700 uppercase tracking-widest mb-3">Alamat Penjemputan</p>
                        <p class="text-xs text-gray-700 leading-6 whitespace-pre-line" x-text="selectedBooking.address"></p>
                    </div>

                    <div class="pt-2">
                        <button
                            @click="modalOpen = false"
                            class="w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-3.5 rounded-xl text-sm transition"
                        >
                            Tutup Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL EDIT LAYANAN --}}
        <div
            x-show="editModalOpen"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 overflow-y-auto bg-gray-950/60 backdrop-blur-sm flex items-center justify-center p-4"
        >
            <div
                @click.away="editModalOpen = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                class="bg-white rounded-[2rem] max-w-lg w-full shadow-2xl overflow-hidden"
            >
                <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-6 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-xs text-sky-100 font-bold uppercase tracking-widest">Service Management</span>
                            <h3 class="font-black text-xl mt-1">Edit Paket Layanan</h3>
                        </div>
                        <button @click="editModalOpen = false" class="w-9 h-9 rounded-xl bg-white/15 hover:bg-white/25 text-2xl transition">
                            &times;
                        </button>
                    </div>
                </div>

                <form :action="'/admin/services/' + editService.id" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                            Nama Layanan
                        </label>
                        <input
                            type="text"
                            name="name"
                            x-model="editService.name"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                            Deskripsi
                        </label>
                        <textarea
                            name="description"
                            rows="3"
                            x-model="editService.description"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition resize-none"
                            required
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                            Harga (Rp)
                        </label>
                        <input
                            type="number"
                            name="price"
                            min="0"
                            x-model="editService.price"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                            Durasi
                        </label>
                        <input
                            type="text"
                            name="duration"
                            x-model="editService.duration"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                        >
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button
                            type="button"
                            @click="editModalOpen = false"
                            class="w-1/2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3.5 rounded-xl text-sm transition"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="w-1/2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-extrabold py-3.5 rounded-xl text-sm shadow-lg shadow-sky-500/20 transition"
                        >
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>