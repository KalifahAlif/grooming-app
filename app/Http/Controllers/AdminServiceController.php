<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;

class AdminServiceController extends Controller
{
    public function adminDashboard()
    {
        $services = Service::all();
        $bookings = Booking::with('service')->get();

        return view('admin.dashboard', compact('services', 'bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'duration' => 'nullable|string|max:255',
            'animal_type' => 'nullable|string|max:255',
        ]);

        Service::create([
            'title' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'animal_type' => $validated['animal_type'] ?? 'Semua',
        ]);

        return redirect()->back()->with('success', 'Paket layanan grooming berhasil ditambahkan!');
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'duration' => 'nullable|string|max:255',
        ]);

        $service->update([
            'title' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
        ]);

        return redirect()->back()->with('success', 'Paket layanan berhasil diperbarui!');
    }

    public function destroyService($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('success', 'Paket layanan berhasil dihapus!');
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,approved,picked_up,grooming,completed,rejected',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status progress pesanan berhasil diperbarui!');
    }

    // Fungsi Hapus Pesanan Masuk
    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Riwayat pesanan berhasil dihapus!');
    }
}