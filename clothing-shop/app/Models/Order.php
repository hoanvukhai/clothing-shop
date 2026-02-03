<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'customer_email',
        'total_money',
        'status',
        'note'
    ];

    protected $casts = [
        'total_money' => 'decimal:2'
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Lấy tên trạng thái đơn hàng
    public function getStatusNameAttribute()
    {
        $statuses = [
            'pending' => 'Chờ duyệt',
            'processing' => 'Đang giao',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy'
        ];
        return $statuses[$this->status] ?? 'Không xác định';
    }

    // Lấy màu badge cho trạng thái
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger'
        ];
        return $badges[$this->status] ?? 'secondary';
    }
}