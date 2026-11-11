<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

// Autentikasi (Login & Register dengan Username)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::post('/email/verification-notification', function () {
        return back()->with('status', 'verification-link-sent');
    })->name('verification.send');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Rute Customer Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/booking', [DashboardController::class, 'storeBooking'])->name('booking.store');

    // Rute Admin Panel
    Route::get('/admin', [AdminServiceController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/admin/services', [AdminServiceController::class, 'store'])->name('admin.services.store');
    Route::put('/admin/services/{id}', [AdminServiceController::class, 'updateService'])->name('admin.services.update');
    Route::delete('/admin/services/{id}', [AdminServiceController::class, 'destroyService'])->name('admin.services.destroy');
    
    Route::patch('/admin/bookings/{id}', [AdminServiceController::class, 'updateBookingStatus'])->name('admin.bookings.update');
    Route::delete('/admin/bookings/{id}', [AdminServiceController::class, 'destroyBooking'])->name('admin.bookings.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});