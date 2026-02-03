<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'customer_id',
        'is_service_center_vehicle',
        'vehicle_name',
        'brand',
        'model',
        'year',
        'plate_number',
        'vehicle_type',
        'fuel_type',
        'transmission_type',
        'image_path',
        'daily_rate',
        'security_deposit',
        'rental_rules',
        'is_listed_for_rent',
        'listing_status',
        'listing_rejection_reason',
        'listing_approved_at',
        'rented_by_user_id',
    ];

    protected $casts = [
        'is_listed_for_rent' => 'boolean',
        'is_service_center_vehicle' => 'boolean',
        'listing_approved_at' => 'datetime',
    ];

    protected $table = 'vehicles';

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class)->orderBy('sort_order');
    }

    public function rentalRequests()
    {
        return $this->hasMany(RentalRequest::class);
    }

    public function approvedRental()
    {
        return $this->hasOne(RentalRequest::class)->where('status', 'Approved')->latestOfMany();
    }

    public function currentStatus()
    {
        $activeStatuses = [
            'Pending',
            'Approved',
            'Assigned',
            'Customer Accepted',
            'In Progress',
            'Waiting for Parts',
        ];

        $hasActiveService = ServiceBooking::where('customer_id', $this->customer_id)
            ->where('vehicle_number', $this->plate_number)
            ->whereIn('status', $activeStatuses)
            ->exists();

        if (!empty($this->rented_by_user_id)) {
            return [
                'status' => 'Rented by Other User',
                'badge_color' => 'red',
                'dot_color' => 'bg-red-500',
                'badge_bg' => 'bg-red-100',
                'badge_text' => 'text-red-700'
            ];
        }

        if ($hasActiveService) {
            return [
                'status' => 'Under Service',
                'badge_color' => 'blue',
                'dot_color' => 'bg-blue-500',
                'badge_bg' => 'bg-blue-100',
                'badge_text' => 'text-blue-700'
            ];
        }

        if ($this->is_listed_for_rent) {
            return [
                'status' => 'Listed for Rent',
                'badge_color' => 'purple',
                'dot_color' => 'bg-purple-500',
                'badge_bg' => 'bg-purple-100',
                'badge_text' => 'text-purple-700'
            ];
        }

        return [
            'status' => 'Available',
            'badge_color' => 'green',
            'dot_color' => 'bg-green-500',
            'badge_bg' => 'bg-green-100',
            'badge_text' => 'text-green-700'
        ];
    }
}
