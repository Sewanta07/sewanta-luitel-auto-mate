<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'vehicle_number',
        'vehicle_type',
        'vehicle_model',
        'service_type',
        'location',
        'phone_number',
        'preferred_date',
        'problem_description',
        'staff_id',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function logs()
    {
        return $this->hasMany(ServiceLog::class);
    }
}
