<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerUser;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
        'service_booking_id',
        'message',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function sender()
    {
        return $this->morphTo();
    }

    public function receiver()
    {
        return $this->morphTo();
    }

    public function booking()
    {
        return $this->belongsTo(ServiceBooking::class, 'service_booking_id');
    }

    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }

    public function isSentByCustomer(): bool
    {
        return $this->sender_type === CustomerUser::class;
    }
}
