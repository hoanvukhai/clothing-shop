<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        // Filter theo status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['orderDetails.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function destroy(Order $order)
    {
        // Chỉ cho phép xóa đơn hàng đã hủy
        if ($order->status !== 'cancelled') {
            return redirect()->back()->with('error', 'Chỉ có thể xóa đơn hàng đã hủy!');
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Xóa đơn hàng thành công!');
    }
}