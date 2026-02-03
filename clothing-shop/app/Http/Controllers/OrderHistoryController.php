<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('orderDetails.product')
            ->latest()
            ->paginate(10);

        return view('orders.history', compact('orders'));
    }

    public function show(Order $order)
    {
        // Kiểm tra quyền xem đơn hàng
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền xem đơn hàng này');
        }

        $order->load('orderDetails.product');
        return view('orders.show', compact('order'));
    }
}
