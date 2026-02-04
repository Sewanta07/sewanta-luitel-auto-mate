<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CustomerUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'phone',
        'current_address',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's role.
     */
    public function getRoleAttribute(): string
    {
        return 'customer';
    }

    /**
     * Get service bookings for this customer.
     */
    public function bookings()
    {
        return $this->hasMany(ServiceBooking::class, 'customer_id');
    }

    /**
     * Get messages sent by this customer.
     */
    public function sentMessages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    /**
     * Get messages received by this customer.
     */
    public function receivedMessages()
    {
        return $this->morphMany(Message::class, 'receiver');
    }
}

