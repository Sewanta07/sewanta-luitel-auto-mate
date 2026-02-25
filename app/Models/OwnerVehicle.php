<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $owner_id
 * @property int $vehicle_id
 * @property float $daily_rate
 * @property string $approval_status
 * @property bool $is_available
 */
class OwnerVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'vehicle_id',
        'daily_rate',
        'approval_status',
        'is_available',
        'approval_note',
        'approved_at',
    ];

    protected $casts = [
        'daily_rate' => 'decimal:2',
        'is_available' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function owner()
    {
        return $this->belongsTo(CustomerUser::class, 'owner_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
