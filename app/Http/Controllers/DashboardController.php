<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking; 
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $services = Service::all(); 
        $myBookings = Booking::where('user_id', Auth::id())->with('service')->get();

        return view('dashboard', compact('services', 'myBookings'));
    }

    public function storeBooking(Request $request)
    {
        // Validasi data dari form dashboard
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'pet_type' => 'required|string|max:255',
            'booking_time' => 'required|date',
            'address' => 'required|string',
        ]);

        // Simpan data pemesanan ke database
        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $validated['service_id'],
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'phone' => $validated['phone'],
            'pet_type' => $validated['pet_type'],
            'booking_time' => $validated['booking_time'],
            'address' => $validated['address'],
            'status' => 'pending', 
        ]);

        return redirect()->back()->with('success', 'Pesanan grooming berhasil dikirim dan menunggu persetujuan admin!');
    }
}