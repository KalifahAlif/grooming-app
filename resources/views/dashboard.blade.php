
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-2xl shadow-lg shadow-sky-500/20">
                    🐾
                </div>
                <div>
                    <h2 class="font-extrabold text-xl sm:text-2xl text-gray-800 tracking-tight">
                        Dashboard Pet Grooming
                    </h2>
                    <p class="text-xs text-gray-400 mt-0.5">Pet Grooming Management System</p>
                </div>
            </div>
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
        x-data="{ bookingModal: false, selectedService: {} }"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-9">

            {{-- HERO BANNER --}}
            <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-7 sm:p-10 lg:p-12 shadow-xl shadow-blue-500/15">

                <div class="absolute -top-24 -right-16 w-80 h-80 rounded-full border-[45px] border-white/10"></div>
                <div class="absolute -bottom-28 left-1/3 w-72 h-72 rounded-full bg-cyan-300/20 blur-3xl"></div>
                <div class="absolute top-10 right-1/3 w-24 h-24 rounded-full bg-white/10 blur-2xl"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-10">
                    <div class="max-w-2xl text-white">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/15 border border-white/20 px-4 py-2 text-xs font-bold tracking-wide backdrop-blur-md mb-6">
                            <span class="w-2 h-2 bg-emerald-300 rounded-full animate-pulse"></span>
                            SELAMAT DATANG DI PET GROOMING
                        </span>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight tracking-tight">
                            Halo, {{ Auth::user()->name ?? Auth::user()->username }}!
                            <span class="block text-cyan-200 mt-2">Saatnya Manjakan Anabul Anda.</span>
                        </h1>

                        <p class="mt-5 text-sm sm:text-base text-sky-100 leading-7 max-w-xl">
                            Berikan perawatan terbaik untuk hewan kesayangan Anda.
                            Pilih layanan grooming favorit dan lakukan booking dengan mudah.
                        </p>

                        <div class="flex flex-wrap gap-3 mt-8">
                            <a href="#paket-layanan"
                               class="inline-flex items-center gap-2 bg-white text-blue-700 hover:bg-sky-50 px-6 py-3.5 rounded-xl font-extrabold text-sm shadow-lg transition hover:-translate-y-1">
                                <span>📅</span>
                                Booking Sekarang
                                <span>→</span>
                            </a>

                            <a href="#riwayat-pesanan"
                               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/30 text-white px-6 py-3.5 rounded-xl font-bold text-sm backdrop-blur-md transition">
                                <span>📋</span>
                                Pesanan Saya
                            </a>
                        </div>
                    </div>

                    <div class="relative flex-shrink-0">
                        <div class="w-52 h-52 sm:w-64 sm:h-64 rounded-full bg-white/10 border border-white/20 backdrop-blur-md flex items-center justify-center shadow-2xl">
                            <div class="text-8xl sm:text-9xl transition duration-500 hover:scale-110 hover:rotate-6">
                                🐈‍⬛
                            </div>
                        </div>
                        <div class="absolute -top-3 -right-4 bg-white rounded-2xl px-4 py-3 shadow-xl rotate-6">
                            <span class="text-2xl">🐶</span>
                        </div>
                        <div class="absolute -bottom-2 -left-5 bg-white rounded-2xl px-4 py-3 shadow-xl -rotate-6">
                            <span class="text-2xl">🐾</span>
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

            {{-- GALERI --}}
            <section class="space-y-5">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
                    <div>
                        <span class="text-xs font-extrabold text-sky-600 uppercase tracking-[0.2em]">
                            Our Gallery
                        </span>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">
                            Galeri Kesenangan Anabul
                        </h3>
                        <p class="text-sm text-gray-500 mt-2">
                            Lihat momen menyenangkan selama proses perawatan.
                        </p>
                    </div>
                    <span class="inline-flex items-center gap-2 text-xs font-bold text-sky-700 bg-sky-100 px-4 py-2 rounded-xl w-fit">
                        
                    </span>
                </div>

                <div
                    x-data="{
                        activeSlide: 1,
                        slides: [
                            {
                                id: 1,
                                title: 'Perawatan Lembut Kucing Kesayangan',
                                image: 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=1400&q=85',
                                desc: 'Kucing mendapatkan mandi relaksasi dan perawatan bulu yang nyaman.'
                            },
                            {
                                id: 2,
                                title: 'Styling dan Potong Bulu Anjing',
                                image: 'https://images.unsplash.com/photo-1535930891776-0c2dfb7fda1a?auto=format&fit=crop&w=1400&q=85',
                                desc: 'Perawatan dan penataan bulu oleh groomer profesional.'
                            },
                            {
                                id: 3,
                                title: 'Anabul Bersih dan Sehat',
                                image: 'https://images.unsplash.com/photo-1574158622682-e40e69881006?auto=format&fit=crop&w=1400&q=85',
                                desc: 'Bulu bersih, sehat, dan membuat anabul semakin nyaman.'
                            },
                            {
                                id: 4,
                                title: 'Momen Bahagia Bersama Anabul',
                                image: 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1400&q=85',
                                desc: 'Memberikan pengalaman perawatan terbaik untuk hewan kesayangan.'
                            }
                        ],
                        init() {
                            setInterval(() => {
                                this.nextSlide();
                            }, 5000);
                        },
                        nextSlide() {
                            this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1;
                        },
                        prevSlide() {
                            this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1;
                        }
                    }"
                    class="relative overflow-hidden rounded-[2rem] bg-gray-900 shadow-xl group"
                >
                    <div class="relative h-72 sm:h-[420px]">
                        <template x-for="slide in slides" :key="slide.id">
                            <div
                                x-show="activeSlide === slide.id"
                                x-transition:enter="transition ease-out duration-700"
                                x-transition:enter-start="opacity-0 scale-105"
                                x-transition:enter-end="opacity-100 scale-100"
                                class="absolute inset-0"
                            >
                                <img
                                    :src="slide.image"
                                    :alt="slide.title"
                                    class="w-full h-full object-cover opacity-80"
                                >

                                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-900/20 to-transparent"></div>

                                <div class="absolute bottom-10 left-6 sm:left-12 right-6 text-white">
                                    <span class="inline-block bg-sky-500 px-3 py-1.5 rounded-lg text-[10px] font-extrabold uppercase tracking-widest mb-4">
                                        GALLERY #<span x-text="slide.id"></span>
                                    </span>
                                    <h4 class="text-2xl sm:text-4xl font-black tracking-tight" x-text="slide.title"></h4>
                                    <p class="text-sm text-gray-200 mt-3 max-w-xl" x-text="slide.desc"></p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <button
                        @click="prevSlide()"
                        aria-label="Foto sebelumnya"
                        class="absolute left-4 sm:left-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/20 hover:bg-white/40 text-white backdrop-blur-md transition opacity-0 group-hover:opacity-100 flex items-center justify-center text-xl"
                    >
                        ❮
                    </button>

                    <button
                        @click="nextSlide()"
                        aria-label="Foto berikutnya"
                        class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/20 hover:bg-white/40 text-white backdrop-blur-md transition opacity-0 group-hover:opacity-100 flex items-center justify-center text-xl"
                    >
                        ❯
                    </button>

                    <div class="absolute bottom-5 right-6 sm:right-12 flex gap-2 z-10">
                        <template x-for="slide in slides" :key="slide.id">
                            <button
                                @click="activeSlide = slide.id"
                                :class="activeSlide === slide.id ? 'w-8 bg-sky-400' : 'w-2.5 bg-white/60'"
                                class="h-2.5 rounded-full transition-all duration-300"
                                :aria-label="'Pilih foto ' + slide.id"
                            ></button>
                        </template>
                    </div>
                </div>
            </section>

            {{-- PAKET LAYANAN --}}
            <section id="paket-layanan" class="scroll-mt-24 space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
                    <div>
                        <span class="text-xs font-extrabold text-sky-600 uppercase tracking-[0.2em]">
                            Our Services
                        </span>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">
                            Pilihan Paket Layanan
                        </h3>
                        <p class="text-sm text-gray-500 mt-2">
                            Temukan perawatan yang tepat untuk hewan kesayangan Anda.
                        </p>
                    </div>

                    <span class="text-xs font-bold text-sky-700 bg-sky-100 px-4 py-2 rounded-xl w-fit">
                        
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($services ?? [] as $service)
                        <div class="group bg-white rounded-3xl border border-sky-100 shadow-sm hover:shadow-xl hover:shadow-sky-500/10 hover:border-sky-300 transition-all duration-300 overflow-hidden flex flex-col">

                            <div class="h-2 bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-500"></div>

                            <div class="p-6 flex flex-col flex-1">
                                <div class="flex justify-between items-center mb-5">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-100 to-blue-100 flex items-center justify-center text-3xl group-hover:scale-110 transition">
                                        🐾
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

                                        <button
                                            @click="bookingModal = true; selectedService = {{ json_encode($service) }}"
                                            class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white text-xs font-extrabold px-4 py-3 rounded-xl shadow-md shadow-sky-500/20 transition hover:-translate-y-1"
                                        >
                                            Booking
                                            <span>→</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-dashed border-sky-200">
                            <div class="text-5xl mb-4">🐾</div>
                            <h4 class="font-bold text-gray-700">Belum Ada Paket Layanan</h4>
                            <p class="text-sm text-gray-400 mt-2">
                                Paket grooming belum tersedia saat ini.
                            </p>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- RIWAYAT PESANAN --}}
            <section id="riwayat-pesanan" class="scroll-mt-24 space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
                    <div>
                        <span class="text-xs font-extrabold text-sky-600 uppercase tracking-[0.2em]">
                            My Bookings
                        </span>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">
                            Riwayat Pesanan Saya
                        </h3>
                        <p class="text-sm text-gray-500 mt-2">
                            Pantau perkembangan layanan grooming Anda.
                        </p>
                    </div>

                    <span class="text-xs font-bold text-indigo-700 bg-indigo-50 border border-indigo-100 px-4 py-2 rounded-xl w-fit">
                       
                    </span>
                </div>

                <div class="bg-white rounded-3xl border border-sky-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-sky-50 to-blue-50 border-b border-sky-100">
                                    <th class="px-6 py-5 text-left text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Layanan</th>
                                    <th class="px-6 py-5 text-left text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Hewan</th>
                                    <th class="px-6 py-5 text-left text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Jadwal</th>
                                    <th class="px-6 py-5 text-center text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @forelse($myBookings ?? [] as $booking)
                                    <tr class="hover:bg-sky-50/40 transition">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <span class="font-bold text-gray-800">
                                                {{ $booking->service->title ?? 'Layanan Grooming' }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-2 text-sm text-gray-600">
                                                🐾 {{ $booking->pet_type }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('d M Y, H:i') }}
                                        </td>

                                        <td class="px-6 py-5 whitespace-nowrap text-center">
                                            @if($booking->status == 'pending')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-amber-50 text-amber-700 text-xs font-bold rounded-full border border-amber-200">
                                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                                    Menunggu
                                                </span>
                                            @elseif($booking->status == 'approved')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-blue-50 text-blue-700 text-xs font-bold rounded-full border border-blue-200">
                                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                                    Disetujui
                                                </span>
                                            @elseif($booking->status == 'picked_up')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full border border-indigo-200">
                                                    <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                                                    Dijemput
                                                </span>
                                            @elseif($booking->status == 'grooming')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-purple-50 text-purple-700 text-xs font-bold rounded-full border border-purple-200">
                                                    <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span>
                                                    Grooming
                                                </span>
                                            @elseif($booking->status == 'completed')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200">
                                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-rose-50 text-rose-700 text-xs font-bold rounded-full border border-rose-200">
                                                    <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-16 text-center">
                                            <div class="w-16 h-16 mx-auto rounded-2xl bg-sky-50 flex items-center justify-center text-3xl mb-4">
                                                📭
                                            </div>
                                            <h4 class="font-extrabold text-gray-700">
                                                Belum Ada Pesanan
                                            </h4>
                                            <p class="text-sm text-gray-400 mt-2">
                                                Yuk, buat pesanan grooming pertama Anda!
                                            </p>
                                            <a href="#paket-layanan" class="inline-flex mt-5 px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-blue-700 text-white text-xs font-bold transition">
                                                Lihat Paket Layanan →
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        {{-- MODAL BOOKING --}}
        <div
            x-show="bookingModal"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 overflow-y-auto bg-gray-950/60 backdrop-blur-sm flex items-center justify-center p-4"
        >
            <div
                @click.away="bookingModal = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                class="bg-white rounded-[2rem] max-w-xl w-full shadow-2xl overflow-hidden"
            >
                <div class="relative bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-600 p-6 sm:p-8 text-white">
                    <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full border-[25px] border-white/10"></div>

                    <div class="relative flex justify-between items-start">
                        <div>
                            <span class="text-xs font-bold text-sky-100 uppercase tracking-widest">
                                Booking Service
                            </span>
                            <h3 class="text-2xl font-black mt-2">
                                Form Booking
                            </h3>
                            <p class="text-sm text-sky-100 mt-1" x-text="selectedService.title"></p>
                        </div>

                        <button
                            type="button"
                            @click="bookingModal = false"
                            class="w-9 h-9 rounded-xl bg-white/15 hover:bg-white/25 text-white text-2xl flex items-center justify-center transition"
                        >
                            &times;
                        </button>
                    </div>
                </div>

                <form action="{{ route('booking.store') }}" method="POST" class="p-6 sm:p-8 space-y-5">
                    @csrf

                    <input type="hidden" name="service_id" :value="selectedService.id">

                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                            Nama Pemilik / Customer
                        </label>
                        <input
                            type="text"
                            name="customer_name"
                            value="{{ Auth::user()->name ?? Auth::user()->username }}"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                            required
                        >
                    </div>

                    <!-- TAMBAHKAN INPUT EMAIL INI -->
                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                            Email Customer
                        </label>
                        <input
                            type="email"
                            name="customer_email"
                            value="{{ Auth::user()->email ?? '' }}"
                            placeholder="email@example.com"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                            required
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                                No. Telepon / WhatsApp
                            </label>
                            <input
                                type="text"
                                name="phone"
                                placeholder="08xxxxxxxxxx"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                                Jenis Hewan & Ras
                            </label>
                            <input
                                type="text"
                                name="pet_type"
                                placeholder="Contoh: Kucing Persia"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                            Jadwal Penjemputan / Kunjungan
                        </label>
                        <input
                            type="datetime-local"
                            name="booking_time"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">
                            Alamat Lengkap Penjemputan
                        </label>
                        <textarea
                            name="address"
                            rows="3"
                            placeholder="Masukkan alamat lengkap Anda..."
                            class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 text-sm p-3.5 transition resize-none"
                            required
                        ></textarea>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button
                            type="button"
                            @click="bookingModal = false"
                            class="w-1/2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3.5 rounded-xl text-sm transition"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="w-1/2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-extrabold py-3.5 rounded-xl shadow-lg shadow-sky-500/20 text-sm transition hover:-translate-y-0.5"
                        >
                            Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
