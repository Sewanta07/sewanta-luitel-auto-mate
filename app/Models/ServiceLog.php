<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ServiceLog extends Model
{
    protected $fillable = [
        'service_booking_id',
        'user_id',
        'user_type',
        'status',
        'notes',
        'attachment_path',
    ];

    public function serviceBooking()
    {
        return $this->belongsTo(ServiceBooking::class);
    }

    /**
     * Alias for serviceBooking() relationship
     */
    public function booking()
    {
        return $this->serviceBooking();
    }

    /**
     * Get the user that performed the action (Admin, Staff, or Customer)
     */
    public function user()
    {
        if (!Schema::hasColumn($this->getTable(), 'user_type')) {
            return $this->belongsTo(User::class, 'user_id');
        }

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
