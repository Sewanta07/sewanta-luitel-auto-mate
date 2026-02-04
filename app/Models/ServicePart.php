<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePart extends Model
{
    protected $table = 'service_parts';

    protected $fillable = [
        'service_booking_id',
        'inventory_item_id',
        'quantity',
        'unit_price',
        'total_cost',
    ];

    public function booking()
    {
        return $this->belongsTo(ServiceBooking::class, 'service_booking_id');
    }

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }
}
