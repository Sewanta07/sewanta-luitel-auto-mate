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
 * @property string|null $position
 */
class StaffMember extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'staff_members';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'position',
        'phone',
        'experience',
        'documents',
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
        return 'staff';
    }

    /**
     * Get service bookings assigned to this staff member.
     */
    public function bookings()
    {
        return $this->hasMany(ServiceBooking::class, 'staff_id');
    }

    /**
     * Get messages sent by this staff member.
     */
    public function sentMessages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    /**
     * Get messages received by this staff member.
     */
    public function receivedMessages()
    {
        return $this->morphMany(Message::class, 'receiver');
    }

    /**
     * Get all messages (sent or received) for this staff member.
     */
    public function messages()
    {
        return $this->sentMessages()->union($this->receivedMessages()->toBase());
    }
}

