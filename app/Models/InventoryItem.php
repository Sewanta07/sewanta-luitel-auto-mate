<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'part_name',
        'category',
        'unit_price',
        'quantity',
        'minimum_stock',
        'status',
        'supplier',
    ];

    public function serviceBookings()
    {
        return $this->belongsToMany(ServiceBooking::class, 'service_parts')
            ->withPivot(['quantity', 'unit_price', 'total_cost'])
            ->withTimestamps();
    }

    public function movements()
    {
        return $this->hasMany(InventoryMovement::class);
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->quantity <= 0) {
            return 'out_of_stock';
        }

        if ($this->quantity <= $this->minimum_stock) {
            return 'low_stock';
        }

        return 'in_stock';
    }
}
