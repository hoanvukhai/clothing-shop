<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        return view('checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'customer_email' => 'nullable|email'
        ], [
            'customer_name.required' => 'Vui lòng nhập họ tên',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại',
            'customer_address.required' => 'Vui lòng nhập địa chỉ'
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        DB::beginTransaction();

        try {
            // Tính tổng tiền
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_email' => $request->customer_email,
                'total_money' => $total,
                'status' => 'pending',
                'note' => $request->note
            ]);

            // Tạo chi tiết đơn hàng và cập nhật số lượng sản phẩm
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->price,
                    'quantity' => $item['quantity']
                ]);

                // Giảm số lượng tồn kho
                $item->product->decrement('quantity', $item->quantity);
            }

            DB::commit();

            // Xóa giỏ hàng
            Cart::where('user_id', Auth::id())->delete();

            return redirect()->route('checkout.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt hàng, vui lòng thử lại!');
        }
    }

    public function success($orderId)
    {
        $order = Order::with('orderDetails.product')->findOrFail($orderId);
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }
        return view('checkout-success', compact('order'));
    }
}