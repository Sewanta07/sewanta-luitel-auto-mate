<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'position',
        'experience',
        'documents',
    ];

    public function staffMember()
    {
        return $this->belongsTo(StaffMember::class);
    }
}

