<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    protected $fillable = [
        'service_booking_id',
        'user_id',
        'status',
        'notes',
    ];

    public function serviceBooking()
    {
        return $this->belongsTo(ServiceBooking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
