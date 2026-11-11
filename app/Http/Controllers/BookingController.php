<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Menampilkan daftar paket & riwayat pesanan user
    public function index()
    {
        $services = Service::all();
        $myBookings = Booking::where('user_id', Auth::id())->with('service')->latest()->get();
        return view('dashboard', compact('services', 'myBookings'));
    }

    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'pet_type' => 'required',
            'booking_time' => 'required|date',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'phone' => $request->phone,
            'address' => $request->address,
            'pet_type' => $request->pet_type,
            'booking_time' => $request->booking_time,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim! Menunggu konfirmasi admin.');
    }
}