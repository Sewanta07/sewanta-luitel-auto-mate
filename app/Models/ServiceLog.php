<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    protected $fillable = [
        'service_booking_id',
        'user_id',
        'user_type',
        'status',
        'notes',
    ];

    public function serviceBooking()
    {
        return $this->belongsTo(ServiceBooking::class);
    }

    /**
     * Get the user that performed the action (Admin, Staff, or Customer)
     */
    public function user()
    {
        return $this->morphTo();
    }
    
    /**
     * Get the user name regardless of type
     */
    public function getUserNameAttribute()
    {
        if ($this->user) {
            return $this->user->name;
        }
        return 'Unknown User';
    }
}
