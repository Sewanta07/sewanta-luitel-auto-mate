<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Payment;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'customer_id',
        'vehicle_number',
        'vehicle_type',
        'vehicle_model',
        'vehicle_name',
        'vehicle_year',
        'service_type',
        'custom_service',
        'preferred_time_slot',
        'service_priority',
        'service_location_type',
        'location',
        'phone_number',
        'preferred_date',
        'problem_description',
        'notes',
        'rental_required',
        'pickup_drop',
        'estimated_cost',
        'service_cost',
        'spare_parts_cost',
        'total_amount',
        'payment_status',
        'expected_completion_date',
        'rejection_reason',
        'staff_id',
        'status',
    ];

    protected $casts = [
        'service_cost' => 'decimal:2',
        'spare_parts_cost' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            if (empty($booking->booking_code)) {
                do {
                    $code = 'BK-' . Str::upper(Str::random(8));
                } while (self::where('booking_code', $code)->exists());

                $booking->booking_code = $code;
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(CustomerUser::class, 'customer_id');
    }

    public function staff()
    {
        return $this->belongsTo(StaffMember::class, 'staff_id');
    }

    public function logs()
    {
        return $this->hasMany(ServiceLog::class);
    }

    public function parts()
    {
        return $this->belongsToMany(InventoryItem::class, 'service_parts')
            ->withPivot(['quantity', 'unit_price', 'total_cost'])
            ->withTimestamps();
    }

    public function payments()
    {
        $baseOrderId = 'service_booking:' . $this->id;

        return Payment::where('type', 'service')
            ->where(function ($query) use ($baseOrderId) {
                $query->where('order_id', $baseOrderId)
                    ->orWhere('order_id', 'like', $baseOrderId . ':%');
            })
            ->orderByDesc('id');
    }
}

