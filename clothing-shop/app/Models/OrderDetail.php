<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    // Quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Tính tổng tiền cho từng chi tiết
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}