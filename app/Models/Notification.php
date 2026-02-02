<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'customer_id',
        'type',
        'title',
        'message',
        'icon_type',
        'related_id',
        'related_type',
        'action_url',
        'action_text',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Get the customer that owns the notification.
     */
    public function customer()
    {
        return $this->belongsTo(CustomerUser::class, 'customer_id');
    }

    /**
     * Mark the notification as read.
     */
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }

    /**
     * Get the icon configuration based on icon_type.
     */
    public function getIconConfig()
    {
        $configs = [
            'info' => [
                'bg' => 'bg-blue-50',
                'text' => 'text-blue-600',
                'border' => 'border-blue-100',
                'label' => 'text-blue-500',
                'shadow' => 'shadow-blue-50/50',
            ],
            'success' => [
                'bg' => 'bg-green-50',
                'text' => 'text-green-600',
                'border' => 'border-green-100',
                'label' => 'text-green-500',
                'shadow' => 'shadow-green-50/50',
            ],
            'warning' => [
                'bg' => 'bg-orange-50',
                'text' => 'text-orange-600',
                'border' => 'border-orange-100',
                'label' => 'text-orange-500',
                'shadow' => 'shadow-orange-50/50',
            ],
            'error' => [
                'bg' => 'bg-red-50',
                'text' => 'text-red-600',
                'border' => 'border-red-100',
                'label' => 'text-red-500',
                'shadow' => 'shadow-red-50/50',
            ],
        ];

        return $configs[$this->icon_type] ?? $configs['info'];
    }
}
