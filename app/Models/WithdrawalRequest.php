<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $owner_id
 * @property float $amount
 * @property string $status
 * @property string|null $note
 * @property string|null $admin_note
 * @property \Illuminate\Support\Carbon|null $requested_at
 * @property \Illuminate\Support\Carbon|null $processed_at
 * @property int|null $processed_by
 */
class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'amount',
        'status',
        'note',
        'admin_note',
        'requested_at',
        'processed_at',
        'processed_by',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function owner()
    {
        return $this->belongsTo(CustomerUser::class, 'owner_id');
    }

    public function processor()
    {
        return $this->belongsTo(Admin::class, 'processed_by');
    }

    public function earnings()
    {
        return $this->belongsToMany(Earning::class, 'withdrawal_request_earnings', 'withdrawal_request_id', 'earning_id')
            ->withTimestamps();
    }
}
