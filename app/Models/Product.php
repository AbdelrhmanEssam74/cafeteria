<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\Category;
use \Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    protected $fillable =['name','description' ,  'price', 'category_id', 'availability', 'image'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
