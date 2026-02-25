<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $vehicle_id
 * @property int|null $owner_id
 * @property int $renter_id
 * @property string $status
 * @property float $total_amount
 * @property float $commission_amount
 * @property float $owner_earning
 * @property float|null $damage_charge
 */
class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_request_id',
        'vehicle_id',
        'owner_id',
        'renter_id',
        'start_date',
        'end_date',
        'number_of_days',
        'total_amount',
        'commission_amount',
        'owner_earning',
        'damage_charge',
        'damage_notes',
        'status',
        'damage_invoice_generated_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_amount' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'owner_earning' => 'decimal:2',
        'damage_charge' => 'decimal:2',
        'damage_invoice_generated_at' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function rentalRequest()
    {
        return $this->belongsTo(RentalRequest::class, 'rental_request_id');
    }

    public function owner()
    {
        return $this->belongsTo(CustomerUser::class, 'owner_id');
    }

    public function renter()
    {
        return $this->belongsTo(CustomerUser::class, 'renter_id');
    }

    public function earning()
    {
        return $this->hasOne(Earning::class);
    }
}
