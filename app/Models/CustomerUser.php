<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $status
 * @property string|null $phone
 */
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

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function rentalsAsOwner()
    {
        return $this->hasMany(Rental::class, 'owner_id');
    }

    public function rentalsAsRenter()
    {
        return $this->hasMany(Rental::class, 'renter_id');
    }

    public function ownerVehicles()
    {
        return $this->hasMany(OwnerVehicle::class, 'owner_id');
    }

    public function earnings()
    {
        return $this->hasMany(Earning::class, 'owner_id');
    }
}

