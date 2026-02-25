<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerUser;

/**
 * @property int $id
 * @property int $vehicle_id
 * @property int $renter_id
 * @property int|null $owner_id
 * @property int|null $assigned_staff_id
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string $status
 * @property string $payment_status
 * @property bool $has_damage
 * @property float|null $damage_charge
 * @property string|null $damage_payment_status
 */
class RentalRequest extends Model
{
    protected $fillable = [
        'vehicle_id',
        'renter_id',
        'owner_id',
        'assigned_staff_id',
        'start_date',
        'end_date',
        'notes',
        'status',
        'approved_at',
        'ready_for_pickup_at',
        'picked_up_at',
        'returned_at',
        'total_cost',
        'payment_status',
        'pre_inspection_notes',
        'post_inspection_notes',
        'pre_inspection_images',
        'post_inspection_images',
        'has_damage',
        'damage_description',
        'damage_charge',
        'damage_payment_status',
        'damage_paid_at',
        'rejection_reason',
    ];

    protected $casts = [
        'pre_inspection_images' => 'array',
        'post_inspection_images' => 'array',
        'has_damage' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'damage_paid_at' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function renter()
    {
        return $this->belongsTo(CustomerUser::class, 'renter_id');
    }

    public function owner()
    {
        return $this->belongsTo(CustomerUser::class, 'owner_id');
    }

    public function assignedStaff()
    {
        return $this->belongsTo(StaffMember::class, 'assigned_staff_id');
    }

    public function rental()
    {
        return $this->hasOne(Rental::class, 'rental_request_id');
    }
}
