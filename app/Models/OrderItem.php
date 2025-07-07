<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;
use \Illuminate\Database\Eloquent\Factories\HasFactory;


class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price','total_price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
