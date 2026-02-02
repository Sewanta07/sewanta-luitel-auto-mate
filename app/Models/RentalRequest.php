<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalRequest extends Model
{
    protected $fillable = [
        'vehicle_id',
        'renter_id',
        'owner_id',
        'start_date',
        'end_date',
        'notes',
        'status',
        'approved_at',
        'returned_at',
        'total_cost',
        'payment_status',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
