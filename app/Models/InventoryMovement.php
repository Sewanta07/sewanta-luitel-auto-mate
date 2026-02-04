<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $fillable = [
        'inventory_item_id',
        'service_booking_id',
        'user_id',
        'user_type',
        'change_type',
        'quantity_change',
        'unit_price',
        'notes',
    ];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }

    public function booking()
    {
        return $this->belongsTo(ServiceBooking::class, 'service_booking_id');
    }
}
