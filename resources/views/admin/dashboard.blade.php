<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                <span>🛡️</span> 
                <span class="bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">
                    Admin Panel - Pet Grooming
                </span>
            </h2>
            <span class="text-xs bg-sky-100 text-sky-800 px-3 py-1.5 rounded-full font-bold shadow-sm border border-sky-200">
                ⚙️ Administrator Access
            </span>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-b from-sky-50/50 via-white to-gray-50 min-h-screen" x-data="{ 
        modalOpen: false, 
        selectedBooking: {},
        editModalOpen: false,
        editService: { id: '', name: '', description: '', price: '', duration: '' }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-sky-500 via-blue-600 to-cyan-600 p-8 shadow-xl text-white">
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                <div class="relative z-10 flex justify-between items-center">
                    <div>
                        <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-semibold mb-3">
                            Pusat Kontrol Utama 🛠️
                        </span>
                        <h3 class="text-3xl font-extrabold tracking-tight">Halo, Admin {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-sky-100 mt-2 max-w-xl text-sm md:text-base">
                            Kelola daftar layanan grooming dan verifikasi pesanan masuk dari para customer dengan mudah di sini.
                        </p>
                    </div>
                    <div class="hidden md:block text-7xl transform hover:scale-110 transition duration-300">
                        🐶✨
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 text-emerald-800 text-sm rounded-r-xl shadow-xs flex items-center gap-2">
                    <span>✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <h4 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2 border-b border-gray-100 pb-3">
                        <span class="p-2 bg-sky-100 rounded-lg text-sky-600 text-sm">➕</span>
                        Tambah Layanan Baru
                    </h4>

                    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nama Layanan</label>
                            <input type="text" name="name" placeholder="Contoh: Full Grooming Spa" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-400 focus:ring-2 focus:ring-sky-200 text-sm p-3 transition" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Deskripsi Singkat</label>
                            <textarea name="description" rows="2" placeholder="Fasilitas yang didapat..." class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-400 focus:ring-2 focus:ring-sky-200 text-sm p-3 transition" required></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Harga (Rp)</label>
                                <input type="number" name="price" placeholder="75000" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-400 focus:ring-2 focus:ring-sky-200 text-sm p-3 transition" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Durasi</label>
                                <input type="text" name="duration" placeholder="45 Menit" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-400 focus:ring-2 focus:ring-sky-200 text-sm p-3 transition">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-sky-500/25 transition duration-150 flex items-center justify-center gap-2">
                                <span>✨</span> Simpan Layanan
                            </button>
                        </div>
                    </form>
                </div>

                <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <h4 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2 border-b border-gray-100 pb-3">
                        <span class="p-2 bg-blue-100 rounded-lg text-blue-600 text-sm">📋</span>
                        Daftar Paket Layanan Aktif
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[420px] overflow-y-auto pr-2">
                        @forelse($services ?? [] as $service)
                            <!-- Kartu Layanan Admin dengan Efek Hover Border Biru -->
                            <div class="p-4 rounded-xl bg-gradient-to-r from-sky-50/50 to-blue-50/50 border border-sky-100 shadow-xs hover:border-sky-400 hover:shadow-md hover:shadow-sky-500/10 transition-all duration-300 flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <h5 class="font-bold text-gray-900">{{ $service->title }}</h5>
                                        <div class="flex items-center gap-1.5">
                                            <button @click="
                                                editModalOpen = true; 
                                                editService.id = '{{ $service->id }}';
                                                editService.name = '{{ addslashes($service->title) }}';
                                                editService.description = '{{ addslashes($service->description) }}';
                                                editService.price = '{{ $service->price }}';
                                                editService.duration = '{{ $service->duration }}';
                                            " class="text-amber-600 hover:text-amber-800 text-xs font-bold px-2 py-1 bg-amber-50 hover:bg-amber-100 rounded-md border border-amber-200 transition">
                                                ✏️ Edit
                                            </button>

                                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paket layanan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-500 hover:text-rose-700 text-xs font-bold px-2 py-1 bg-rose-50 hover:bg-rose-100 rounded-md border border-rose-200 transition">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1">{{ $service->description }}</p>
                                </div>
                                <div class="mt-4 pt-3 border-t border-sky-100/60 flex justify-between items-center">
                                    <span class="text-xs font-semibold text-sky-700 bg-sky-100 px-2.5 py-1 rounded-md">
                                        ⏱️ {{ $service->duration ?? '-' }}
                                    </span>
                                    <span class="font-extrabold text-sm text-gray-900">
                                        Rp {{ number_format($service->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm col-span-2 text-center py-6">Belum ada layanan yang ditambahkan.</p>
                        @endforelse
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                <h4 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2 border-b border-gray-100 pb-3">
                    <span class="p-2 bg-cyan-100 rounded-lg text-cyan-600 text-sm">📥</span>
                    Kelola Pesanan Masuk Customer
                </h4>
                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-sky-50/30">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Layanan & Hewan</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Jadwal</th>
                                <th class="px-6 py-3.5 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Update Progress & Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-sm">
                            @forelse($bookings ?? [] as $booking)
                                <tr class="hover:bg-sky-50/20 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-gray-900">{{ $booking->customer_name }}</div>
                                        <div class="text-xs text-gray-500">{{ $booking->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-semibold text-sky-700">{{ $booking->service->title ?? 'Layanan' }}</div>
                                        <div class="text-xs text-gray-600">🐾 {{ $booking->pet_type }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 text-xs">
                                        📅 {{ \Carbon\Carbon::parse($booking->booking_time)->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button @click="modalOpen = true; selectedBooking = {{ json_encode([
                                                'customer_name' => $booking->customer_name,
                                                'customer_email' => $booking->customer_email ?? '-',
                                                'phone' => $booking->phone,
                                                'service_title' => $booking->service->title ?? 'Layanan',
                                                'pet_type' => $booking->pet_type,
                                                'booking_time' => \Carbon\Carbon::parse($booking->booking_time)->format('d M Y, H:i'),
                                                'address' => $booking->address,
                                                'status' => $booking->status
                                            ]) }}" class="px-3 py-1 bg-sky-50 hover:bg-sky-100 text-sky-700 text-xs font-bold rounded-lg border border-sky-200 transition">
                                                🔍 Detail
                                            </button>

                                            <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="inline-flex items-center">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded-lg border-gray-300 bg-gray-50 p-1.5 focus:border-sky-400 focus:ring-sky-200 cursor-pointer">
                                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                                    <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>✅ Disetujui</option>
                                                    <option value="picked_up" {{ $booking->status == 'picked_up' ? 'selected' : '' }}>🚗 Sedang Dijemput</option>
                                                    <option value="grooming" {{ $booking->status == 'grooming' ? 'selected' : '' }}>🛁 Proses Grooming</option>
                                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>🎉 Selesai</option>
                                                    <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
                                                </select>
                                            </form>

                                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat pesanan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2.5 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-lg border border-rose-200 transition" title="Hapus Pesanan">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-400 bg-gray-50/50">
                                        <div class="text-3xl mb-1">📭</div>
                                        Belum ada pesanan masuk dari customer.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-xs flex items-center justify-center p-4" x-cloak>
            <div @click.away="modalOpen = false" class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-sky-100 space-y-4">
                <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                    <h3 class="font-extrabold text-lg text-gray-800 flex items-center gap-2">
                        <span>📋</span> Detail Lengkap Pesanan
                    </h3>
                    <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
                </div>

                <div class="space-y-3 text-sm text-gray-700">
                    <div class="bg-sky-50/50 p-3 rounded-xl border border-sky-100">
                        <span class="text-xs font-bold text-sky-700 uppercase tracking-wider block mb-1">Informasi Customer</span>
                        <p class="font-bold text-gray-900" x-text="selectedBooking.customer_name"></p>
                        <p class="text-xs text-gray-600" x-text="'Email: ' + selectedBooking.customer_email"></p>
                        <p class="text-xs text-gray-600" x-text="'No. Telepon: ' + selectedBooking.phone"></p>
                    </div>

                    <div class="bg-gray-50 p-3 rounded-xl border border-gray-200">
                        <span class="text-xs font-bold text-sky-700 uppercase tracking-wider block mb-1">Detail Layanan & Hewan</span>
                        <p class="font-bold text-sky-700" x-text="selectedBooking.service_title"></p>
                        <p class="text-xs text-gray-600" x-text="'Jenis Hewan / Catatan: ' + selectedBooking.pet_type"></p>
                        <p class="text-xs text-gray-600" x-text="'Jadwal Penjemputan: ' + selectedBooking.booking_time"></p>
                    </div>

                    <div class="bg-blue-50/50 p-3 rounded-xl border border-blue-100">
                        <span class="text-xs font-bold text-blue-700 uppercase tracking-wider block mb-1">Alamat Penjemputan / Catatan Khusus</span>
                        <p class="text-xs text-gray-800 font-medium whitespace-pre-line" x-text="selectedBooking.address"></p>
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100 flex justify-end">
                    <button @click="modalOpen = false" class="px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-xs font-bold rounded-xl transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <div x-show="editModalOpen" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-xs flex items-center justify-center p-4" x-cloak>
            <div @click.away="editModalOpen = false" class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-sky-100 space-y-4">
                <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                    <h3 class="font-extrabold text-lg text-gray-800 flex items-center gap-2">
                        <span>✏️</span> Edit Paket Layanan
                    </h3>
                    <button @click="editModalOpen = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
                </div>

                <form :action="'/admin/services/' + editService.id" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nama Layanan</label>
                        <input type="text" name="name" x-model="editService.name" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-400 text-sm p-3 transition" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Deskripsi Singkat</label>
                        <textarea name="description" rows="2" x-model="editService.description" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-400 text-sm p-3 transition" required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Harga (Rp)</label>
                            <input type="number" name="price" x-model="editService.price" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-400 text-sm p-3 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Durasi</label>
                            <input type="text" name="duration" x-model="editService.duration" class="w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-400 text-sm p-3 transition">
                        </div>
                    </div>

                    <div class="pt-2 flex gap-3">
                        <button type="button" @click="editModalOpen = false" class="w-1/2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl text-xs transition">
                            Batal
                        </button>
                        <button type="submit" class="w-1/2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-amber-500/25 text-xs transition">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>