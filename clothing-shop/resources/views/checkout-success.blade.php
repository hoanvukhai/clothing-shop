@extends('layouts.app')

@section('title', 'Đặt hàng thành công - Fashion Shop')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Success Message -->
            <div class="text-center mb-5">
                <div style="display: inline-block; width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-check" style="font-size: 2.5rem; color: white;"></i>
                </div>
                <h2 class="mt-4 mb-2" style="font-weight: 700; color: #333;">Đặt hàng thành công!</h2>
                <p style="font-size: 1.1rem; color: #666;">Cảm ơn bạn đã tin tưởng Fashion Shop. Đơn hàng sẽ được xử lý sớm.</p>
            </div>

            <!-- Order ID Card -->
            <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 2px solid #667eea;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px 12px 0 0; text-align: center;">
                    <p class="mb-0" style="opacity: 0.9;">Mã đơn hàng</p>
                    <h3 style="margin: 0; font-weight: 700; font-size: 2rem;">#{{ $order->id }}</h3>
                </div>
                <div class="card-body" style="text-align: center; padding: 1.5rem;">
                    <p class="text-muted mb-0">Bạn sẽ nhận được email xác nhận tại {{ $order->customer_email ?? Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Delivery Info -->
            <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px 12px 0 0;">
                    <h5 style="margin: 0; font-weight: 700;"><i class="fas fa-map-marker-alt"></i> Thông tin giao hàng</h5>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-3">
                                    <strong style="color: #333;"><i class="fas fa-user" style="color: #667eea;"></i> Người nhận</strong><br>
                                    <span style="font-size: 1.05rem; color: #666;">{{ $order->customer_name }}</span>
                                </p>
                                <p class="mb-0">
                                    <strong style="color: #333;"><i class="fas fa-phone" style="color: #667eea;"></i> Điện thoại</strong><br>
                                    <span style="font-size: 1.05rem; color: #666;">{{ $order->customer_phone }}</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                @if($order->customer_email)
                                    <p class="mb-3">
                                        <strong style="color: #333;"><i class="fas fa-envelope" style="color: #667eea;"></i> Email</strong><br>
                                        <span style="font-size: 1.05rem; color: #666;">{{ $order->customer_email }}</span>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <p class="mb-0">
                            <strong style="color: #333;"><i class="fas fa-home" style="color: #667eea;"></i> Địa chỉ giao hàng</strong><br>
                            <span style="font-size: 1.05rem; color: #666;">{{ $order->customer_address }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px 12px 0 0;">
                    <h5 style="margin: 0; font-weight: 700;"><i class="fas fa-receipt"></i> Chi tiết đơn hàng</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr style="background: #f8f9fa;">
                                <th style="border: none; padding: 1rem;">Sản phẩm</th>
                                <th style="border: none; padding: 1rem;" class="text-center">Số lượng</th>
                                <th style="border: none; padding: 1rem;" class="text-right">Giá</th>
                                <th style="border: none; padding: 1rem;" class="text-right">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $detail)
                                <tr>
                                    <td style="border-bottom: 1px solid #e0e0e0; padding: 1rem;">
                                        <strong style="color: #333;">{{ $detail->product->name }}</strong>
                                    </td>
                                    <td style="border-bottom: 1px solid #e0e0e0; padding: 1rem;" class="text-center">
                                        {{ $detail->quantity }}
                                    </td>
                                    <td style="border-bottom: 1px solid #e0e0e0; padding: 1rem;" class="text-right">
                                        <span style="color: #667eea; font-weight: 600;">{{ number_format($detail->price, 0, ',', '.') }}₫</span>
                                    </td>
                                    <td style="border-bottom: 1px solid #e0e0e0; padding: 1rem;" class="text-right">
                                        <strong style="color: #f093fb; font-size: 1.05rem;">{{ number_format($detail->subtotal, 0, ',', '.') }}₫</strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary -->
                <div class="card-body" style="padding: 1.5rem; background: #f8f9fa;">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div style="margin-bottom: 12px;">
                                <div class="d-flex justify-content-between mb-2">
                                    <span style="color: #666;">Tạm tính:</span>
                                    <strong style="color: #333;">{{ number_format($order->total_money, 0, ',', '.') }}₫</strong>
                                </div>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <div class="d-flex justify-content-between mb-2">
                                    <span style="color: #666;">Vận chuyển:</span>
                                    <strong style="color: #28a745;">Miễn phí</strong>
                                </div>
                            </div>
                            <hr style="border: 1px dashed #e0e0e0;">
                            <div class="d-flex justify-content-between">
                                <span style="font-weight: 700; font-size: 1.1rem;">Tổng cộng:</span>
                                <strong style="font-size: 1.3rem; color: #f093fb;">{{ number_format($order->total_money, 0, ',', '.') }}₫</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="alert alert-info" style="background: #d1ecf1; border: 1px solid #bee5eb; border-radius: 8px; margin-bottom: 2rem;">
                <i class="fas fa-info-circle"></i> <strong>Các bước tiếp theo:</strong>
                <ol class="mb-0 mt-2">
                    <li>Đơn hàng sẽ được xác nhận trong vòng 24 giờ</li>
                    <li>Sản phẩm sẽ được gửi từ kho</li>
                    <li>Bạn sẽ thanh toán khi nhận hàng (COD)</li>
                </ol>
            </div>

            <!-- Action Buttons -->
            <div class="row gap-2">
                <div class="col-md-6">
                    <a href="{{ route('home') }}" class="btn w-100" style="background: white; border: 2px solid #667eea; color: #667eea; font-weight: 600; padding: 12px; border-radius: 8px;">
                        <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('orders.show', $order->id) }}" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 600; padding: 12px; border-radius: 8px; border: none;">
                        <i class="fas fa-eye"></i> Xem chi tiết đơn hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
