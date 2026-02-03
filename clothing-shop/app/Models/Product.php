<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'quantity',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Tự động tạo slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ với OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Lấy sản phẩm cùng danh mục (cho "Sản phẩm liên quan")
    public function getRelatedProducts($limit = 4)
    {
        return self::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }
}