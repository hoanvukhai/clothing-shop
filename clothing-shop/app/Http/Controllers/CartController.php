<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantityToAdd = 1;

        // Kiểm tra số lượng tồn kho
        if ($product->quantity < $quantityToAdd) {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng!');
        }

        $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $id)->first();

        if ($cartItem) {
            // Sản phẩm đã có trong giỏ, tăng số lượng
            if ($cartItem->quantity + $quantityToAdd > $product->quantity) {
                return redirect()->back()->with('error', 'Số lượng sản phẩm không đủ!');
            }
            $cartItem->increment('quantity', $quantityToAdd);
        } else {
            // Thêm sản phẩm mới
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => $quantityToAdd,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $quantity = $request->quantity;

        if ($cartItem) {
            $product = $cartItem->product;

            // Kiểm tra số lượng tồn kho
            if ($quantity > $product->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng sản phẩm không đủ!'
                ]);
            }

            if ($quantity <= 0) {
                $cartItem->delete();
            } else {
                $cartItem->update(['quantity' => $quantity]);
            }

            // Tính lại tổng tiền
            $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }

            $itemTotal = $product->price * $quantity;

            return response()->json([
                'success' => true,
                'itemTotal' => number_format($itemTotal, 0, ',', '.').'₫',
                'total' => number_format($total, 0, ',', '.').'₫'
            ]);
        }

        return response()->json(['success' => false]);
    }

    public function remove($id)
    {
        Cart::where('user_id', auth()->id())->where('product_id', $id)->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }
}