@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id . ' - Fashion Shop')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #667eea; text-decoration: none;"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}" style="color: #667eea; text-decoration: none;"><i class="fas fa-shopping-bag"></i> Đơn hàng</a></li>
            <li class="breadcrumb-item active">#{{ $order->id }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8 mb-4">
            <a href="{{ route('orders.index') }}" class="btn mb-3" style="background: white; border: 2px solid #667eea; color: #667eea; font-weight: 600; border-radius: 8px;">
                <i class="fas fa-arrow-left"></i> Quay lại lịch sử
            </a>

            <!-- Order Details Card -->
            <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px 12px 0 0;">
                    <h4 style="margin: 0; font-weight: 700;">
                        <i class="fas fa-shopping-bag"></i> Đơn hàng #{{ $order->id }}
                    </h4>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 style="font-weight: 700; color: #333; margin-bottom: 1rem;">
                                <i class="fas fa-info-circle" style="color: #667eea;"></i> Thông tin đơn hàng
                            </h6>
                            <p class="mb-2">
                                <strong style="color: #333;">Ngày đặt:</strong><br>
                                <i class="fas fa-calendar"></i> {{ $order->created_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="mb-0">
                                <strong style="color: #333;">Trạng thái:</strong><br>
                                @if($order->status === 'pending')
                                    <span class="badge" style="background: #fff3cd; color: #856404; padding: 6px 12px; border-radius: 20px; font-weight: 600;">
                                        <i class="fas fa-clock"></i> Chờ duyệt
                                    </span>
                                @elseif($order->status === 'processing')
                                    <span class="badge" style="background: #cce5ff; color: #004085; padding: 6px 12px; border-radius: 20px; font-weight: 600;">
                                        <i class="fas fa-truck"></i> Đang giao
                                    </span>
                                @elseif($order->status === 'completed')
                                    <span class="badge" style="background: #d4edda; color: #155724; padding: 6px 12px; border-radius: 20px; font-weight: 600;">
                                        <i class="fas fa-check"></i> Hoàn thành
                                    </span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge" style="background: #f8d7da; color: #721c24; padding: 6px 12px; border-radius: 20px; font-weight: 600;">
                                        <i class="fas fa-times"></i> Đã hủy
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 style="font-weight: 700; color: #333; margin-bottom: 1rem;">
                                <i class="fas fa-truck" style="color: #667eea;"></i> Thông tin giao hàng
                            </h6>
                            <p class="mb-2">
                                <strong style="color: #333;">Người nhận:</strong><br>
                                {{ $order->customer_name }}
                            </p>
                            <p class="mb-2">
                                <strong style="color: #333;">Điện thoại:</strong><br>
                                <i class="fas fa-phone"></i> {{ $order->customer_phone }}
                            </p>
                            @if($order->customer_email)
                                <p class="mb-0">
                                    <strong style="color: #333;">Email:</strong><br>
                                    <i class="fas fa-envelope"></i> {{ $order->customer_email }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <hr style="border: 1px dashed #e0e0e0;">

                    <p class="mb-2">
                        <strong style="color: #333;"><i class="fas fa-home" style="color: #667eea;"></i> Địa chỉ giao hàng:</strong><br>
                        <span style="color: #666;">{{ $order->customer_address }}</span>
                    </p>
                </div>
            </div>

            <!-- Products Card -->
            <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px 12px 0 0;">
                    <h5 style="margin: 0; font-weight: 700;">
                        <i class="fas fa-list"></i> Chi tiết sản phẩm
                    </h5>
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
                                        <a href="{{ route('product', $detail->product->slug) }}" class="text-decoration-none" style="color: #667eea; font-weight: 600;">
                                            {{ $detail->product->name }}
                                        </a>
                                    </td>
                                    <td style="border-bottom: 1px solid #e0e0e0; padding: 1rem;" class="text-center">
                                        {{ $detail->quantity }}
                                    </td>
                                    <td style="border-bottom: 1px solid #e0e0e0; padding: 1rem;" class="text-right">
                                        <span style="color: #667eea;">{{ number_format($detail->price, 0, ',', '.') }}₫</span>
                                    </td>
                                    <td style="border-bottom: 1px solid #e0e0e0; padding: 1rem;" class="text-right">
                                        <strong style="color: #f093fb;">{{ number_format($detail->subtotal, 0, ',', '.') }}₫</strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="background: #f8f9fa; padding: 1.5rem;">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-2">
                                <span style="color: #666;">Tạm tính:</span>
                                <span style="color: #333; font-weight: 600;">{{ number_format($order->total_money, 0, ',', '.') }}₫</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span style="color: #666;">Vận chuyển:</span>
                                <strong style="color: #28a745;">Miễn phí</strong>
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

            <!-- Note -->
            @if($order->note)
                <div class="alert alert-info" style="background: #d1ecf1; border: 1px solid #bee5eb; border-radius: 8px;">
                    <i class="fas fa-sticky-note"></i> <strong>Ghi chú:</strong> {{ $order->note }}
                </div>
            @endif

            <!-- Status Messages -->
            @if($order->status === 'pending')
                <div class="alert alert-warning" style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Đơn hàng chờ xác nhận.</strong> 
                    Chúng tôi sẽ liên hệ với bạn trong vòng 24 giờ.
                </div>
            @elseif($order->status === 'processing')
                <div class="alert alert-info" style="background: #d1ecf1; border: 1px solid #bee5eb; border-radius: 8px;">
                    <i class="fas fa-truck"></i>
                    <strong>Đơn hàng đang được giao.</strong> 
                    Vui lòng chú ý điện thoại để liên hệ với tài xế.
                </div>
            @elseif($order->status === 'completed')
                <div class="alert alert-success" style="background: #d4edda; border: 1px solid #c3e6cb; border-radius: 8px;">
                    <i class="fas fa-check-circle"></i>
                    <strong>Đơn hàng đã hoàn thành.</strong> 
                    Cảm ơn bạn đã mua sắm tại Fashion Shop!
                </div>
            @elseif($order->status === 'cancelled')
                <div class="alert alert-danger" style="background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px;">
                    <i class="fas fa-times-circle"></i>
                    <strong>Đơn hàng đã bị hủy.</strong>
                </div>
            @endif
        </div>

        <!-- Right Column - Summary -->
        <div class="col-lg-4">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; position: sticky; top: 80px;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px 12px 0 0;">
                    <h5 style="margin: 0; font-weight: 700;">
                        <i class="fas fa-receipt"></i> Tóm tắt
                    </h5>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 8px; margin-bottom: 1rem;">
                        <p style="margin: 0; color: #666;">Tổng sản phẩm</p>
                        <p style="margin: 0; font-size: 1.3rem; font-weight: 700; color: #333;">
                            {{ $order->orderDetails->sum('quantity') }}
                        </p>
                    </div>

                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 8px; margin-bottom: 1rem;">
                        <p style="margin: 0; color: #666;">Tổng tiền</p>
                        <p style="margin: 0; font-size: 1.3rem; font-weight: 700; color: #f093fb;">
                            {{ number_format($order->total_money, 0, ',', '.') }}₫
                        </p>
                    </div>

                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 8px;">
                        <p style="margin: 0; color: #666;">Phương thức thanh toán</p>
                        <p style="margin: 0; font-size: 1rem; font-weight: 600; color: #333;">
                            <i class="fas fa-money-bill-wave"></i> Thanh toán khi nhận hàng
                        </p>
                    </div>

                    <hr style="border: 1px dashed #e0e0e0; margin: 1.5rem 0;">

                    <a href="{{ route('home') }}" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 600; padding: 12px; border-radius: 8px; border: none;">
                        <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
