<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                <span>🐾</span> 
                <span class="bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">
                    Dashboard Pet Grooming
                </span>
            </h2>
            <span class="text-xs bg-sky-100 text-sky-800 px-3 py-1.5 rounded-full font-bold shadow-sm border border-sky-200">
                ✨ Layanan Perawatan Anabul
            </span>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-b from-sky-50/50 via-white to-gray-50 min-h-screen" x-data="{ bookingModal: false, selectedService: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-sky-500 via-blue-600 to-cyan-600 p-8 sm:p-10 shadow-xl text-white">
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -left-10 -top-10 w-48 h-48 bg-cyan-300/20 rounded-full blur-2xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <span class="inline-block px-3.5 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-xs font-semibold mb-3 shadow-xs">
                            🐶 Selamat Datang, {{ Auth::user()->name ?? Auth::user()->username }}!
                        </span>
                        <h3 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Manjakan Hewan Kesayangan Anda.</h3>
                        <p class="text-sky-100 mt-2 max-w-xl text-sm sm:text-base leading-relaxed">
                            Pilih paket layanan *grooming* profesional terbaik kami dan jadwalkan penjemputan anabul Anda sekarang juga.
                        </p>
                    </div>
                    <div class="text-6xl sm:text-7xl bg-white/10 p-4 rounded-2xl backdrop-blur-md shadow-inner">
                        🐈🐕
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 text-emerald-800 text-sm rounded-r-xl shadow-xs flex items-center gap-2">
                    <span>✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-sky-100">
                <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                    <div>
                        <h4 class="text-xl font-extrabold text-gray-900">Pilihan Paket Layanan</h4>
                        <p class="text-xs sm:text-sm text-gray-500">Pilih perawatan terbaik yang sesuai untuk anabul Anda.</p>
                    </div>
                    <span class="text-xs font-bold text-sky-600 bg-sky-50 px-3 py-1.5 rounded-xl border border-sky-100">
                        ✨ Terpercaya & Profesional
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($services ?? [] as $service)
                        <!-- Kartu Layanan dengan Efek Hover Border Biru -->
                        <div class="bg-gradient-to-br from-sky-50/40 via-white to-blue-50/30 rounded-2xl p-6 border border-sky-100 shadow-sm hover:border-sky-400 hover:shadow-lg hover:shadow-sky-500/10 transition-all duration-300 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-3">
                                    <span class="p-2.5 bg-sky-100 rounded-xl text-lg shadow-xs">🐾</span>
                                    <span class="text-xs font-extrabold text-sky-700 bg-sky-100/80 px-2.5 py-1 rounded-lg">
                                        ⏱️ {{ $service->duration ?? '30 Menit' }}
                                    </span>
                                </div>
                                <h5 class="font-extrabold text-lg text-gray-900">{{ $service->title }}</h5>
                                <p class="text-xs sm:text-sm text-gray-600 mt-2 leading-relaxed">{{ $service->description }}</p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-sky-100/60 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] uppercase font-bold text-gray-400 block tracking-wider">Harga Mulai</span>
                                    <span class="font-extrabold text-base text-gray-900">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                </div>
                                <button @click="bookingModal = true; selectedService = {{ json_encode($service) }}" 
                                    class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs shadow-md shadow-sky-500/20 transition flex items-center gap-1.5">
                                    <span>📅</span> Booking Sekarang
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 text-gray-400 bg-gray-50/50 rounded-2xl border border-dashed border-gray-200">
                            <div class="text-4xl mb-2">🏷️</div>
                            Belum ada paket layanan grooming yang tersedia saat ini.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-sky-100">
                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h4 class="text-xl font-extrabold text-gray-900">Riwayat & Status Pesanan Saya</h4>
                    <p class="text-xs sm:text-sm text-gray-500">Pantau proses perawatan anabul Anda secara *real-time*.</p>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-sky-50/30">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Layanan</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Hewan / Peliharaan</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Jadwal</th>
                                <th class="px-6 py-3.5 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Status Progress</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-sm">
                            @forelse($myBookings ?? [] as $booking)
                                <tr class="hover:bg-sky-50/20 transition">
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-sky-700">
                                        {{ $booking->service->title ?? 'Layanan Grooming' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                        🐾 {{ $booking->pet_type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 text-xs">
                                        📅 {{ \Carbon\Carbon::parse($booking->booking_time)->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($booking->status == 'pending')
                                            <span class="px-3 py-1 bg-amber-50 text-amber-700 text-xs font-bold rounded-full border border-amber-200">⏳ Pending / Menunggu</span>
                                        @elseif($booking->status == 'approved')
                                            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-full border border-blue-200">✅ Disetujui Admin</span>
                                        @elseif($booking->status == 'picked_up')
                                            <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full border border-indigo-200">🚗 Sedang Dijemput</span>
                                        @elseif($booking->status == 'grooming')
                                            <span class="px-3 py-1 bg-purple-50 text-purple-700 text-xs font-bold rounded-full border border-purple-200">🛁 Proses Grooming</span>
                                        @elseif($booking->status == 'completed')
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200">🎉 Selesai</span>
                                        @else
                                            <span class="px-3 py-1 bg-rose-50 text-rose-700 text-xs font-bold rounded-full border border-rose-200">❌ Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 bg-gray-50/50">
                                        <div class="text-3xl mb-1">📭</div>
                                        Anda belum memiliki riwayat pesanan grooming. Yuk buat pesanan pertama Anda!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div x-show="bookingModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-xs flex items-center justify-center p-4" x-cloak>
            <div @click.away="bookingModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-sky-100 space-y-6">
                <div class="flex justify-between items-center border-b border-gray-100 pb-4">
                    <div>
                        <h3 class="font-extrabold text-lg text-gray-900">Form Booking Layanan</h3>
                        <p class="text-xs text-sky-600 font-bold" x-text="selectedService.title"></p>
                    </div>
                    <button @click="bookingModal = false" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
                </div>

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="service_id" :value="selectedService.id">

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nama Pemilik / Customer</label>
                        <input type="text" name="customer_name" value="{{ Auth::user()->name }}" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm p-3 transition" required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">No. Telepon / WhatsApp</label>
                            <input type="text" name="phone" placeholder="08xxxxxxxxxx" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm p-3 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Jenis Hewan & Ras</label>
                            <input type="text" name="pet_type" placeholder="Contoh: Kucing Persia" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm p-3 transition" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Jadwal Penjemputan / Kunjungan</label>
                        <input type="datetime-local" name="booking_time" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm p-3 transition" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Alamat Lengkap Penjemputan</label>
                        <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap Anda..." class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm p-3 transition" required></textarea>
                    </div>

                    <div class="pt-2 flex gap-3">
                        <button type="button" @click="bookingModal = false" class="w-1/2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3.5 rounded-xl text-xs transition">
                            Batal
                        </button>
                        <button type="submit" class="w-1/2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-sky-500/25 text-xs transition flex items-center justify-center gap-1.5">
                            <span>🚀</span> Konfirmasi Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>