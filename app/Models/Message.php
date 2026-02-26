<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function sender()
    {
        if (Schema::hasColumn($this->getTable(), 'sender_type')) {
            return $this->morphTo(__FUNCTION__, 'sender_type', 'sender_id');
        }

        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        if (Schema::hasColumn($this->getTable(), 'receiver_type')) {
            return $this->morphTo(__FUNCTION__, 'receiver_type', 'receiver_id');
        }

        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
            ]);
        }
    }

    public function isSentBy(int $userId): bool
    {
        return (int) $this->sender_id === $userId;
    }

    public function isSentByCustomer(): bool
    {
        return optional($this->sender)->role === 'customer';
    }
}
