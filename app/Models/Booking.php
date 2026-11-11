<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'customer_name',
        'customer_email',
        'phone',
        'pet_type',
        'booking_time',
        'address',
        'status',
    ];

    // Tambahkan fungsi relasi ini
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}