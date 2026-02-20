<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'rental_id',
        'commission',
        'owner_amount',
        'payout_status',
        'paid_out_at',
    ];

    protected $casts = [
        'commission' => 'decimal:2',
        'owner_amount' => 'decimal:2',
        'paid_out_at' => 'datetime',
    ];

    public function owner()
    {
        return $this->belongsTo(CustomerUser::class, 'owner_id');
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
