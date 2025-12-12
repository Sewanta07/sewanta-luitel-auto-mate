<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}

