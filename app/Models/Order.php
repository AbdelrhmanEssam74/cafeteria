<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'canceled';
    protected $fillable = [
        'user_id',
        'order_number',
        'total_price',
        'status',
        'payment_method',
        'shipping_address',
        'billing_address',
        'notes',
        'room_number'
    ];
    protected $casts = [
        'total_price' => 'decimal:2',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // In App\Models\Order.php
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Add this alias relationship
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    public function canBeCancelled()
    {
        return $this->status === self::STATUS_PENDING;
    }
    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_PENDING => 'badge bg-warning',
            self::STATUS_COMPLETED => 'badge bg-success',
            self::STATUS_CANCELLED => 'badge bg-danger',
        ];

        return $badges[$this->status] ?? 'badge bg-secondary';
    }
}
