@extends('layouts.app')

@section('title', 'Thanh toán - Fashion Shop')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #667eea; text-decoration: none;"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" style="color: #667eea; text-decoration: none;"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a></li>
            <li class="breadcrumb-item active"><i class="fas fa-credit-card"></i> Thanh toán</li>
        </ol>
    </nav>

    <h1 class="section-title mb-5"><i class="fas fa-credit-card"></i> Hoàn tất đơn hàng</h1>

    <div class="row">
        <!-- Checkout Form -->
        <div class="col-lg-8 mb-4">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px 12px 0 0;">
                    <h5 style="margin: 0; font-weight: 700;"><i class="fas fa-map-marker-alt"></i> Thông tin giao hàng</h5>
                </div>
                <div class="card-body" style="padding: 2rem;">
                    <form action="{{ route('checkout.store') }}" method="POST" novalidate>
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label for="customer_name" class="form-label">Họ và tên <span style="color: #f093fb;">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="border: 1px solid #e0e0e0; background: white;">
                                    <i class="fas fa-user" style="color: #667eea;"></i>
                                </span>
                                <input type="text" id="customer_name" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', Auth::user()->name) }}" required placeholder="Nhập tên của bạn" style="border: 1px solid #e0e0e0;">
                            </div>
                            @error('customer_name')
                                <div class="invalid-feedback d-block" style="font-size: 0.9rem; color: #dc3545;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="customer_phone" class="form-label">Số điện thoại <span style="color: #f093fb;">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="border: 1px solid #e0e0e0; background: white;">
                                    <i class="fas fa-phone" style="color: #667eea;"></i>
                                </span>
                                <input type="tel" id="customer_phone" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" required placeholder="0912345678" style="border: 1px solid #e0e0e0;">
                            </div>
                            @error('customer_phone')
                                <div class="invalid-feedback d-block" style="font-size: 0.9rem; color: #dc3545;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="customer_email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text" style="border: 1px solid #e0e0e0; background: white;">
                                    <i class="fas fa-envelope" style="color: #667eea;"></i>
                                </span>
                                <input type="email" id="customer_email" name="customer_email" class="form-control" value="{{ old('customer_email', Auth::user()->email) }}" placeholder="your@email.com" style="border: 1px solid #e0e0e0;">
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="customer_address" class="form-label">Địa chỉ giao hàng <span style="color: #f093fb;">*</span></label>
                            <textarea id="customer_address" name="customer_address" class="form-control @error('customer_address') is-invalid @enderror" rows="3" required placeholder="123 Đường ABC, Phường XYZ..." style="border: 1px solid #e0e0e0;">{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                                <div class="invalid-feedback d-block" style="font-size: 0.9rem; color: #dc3545;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Note -->
                        <div class="mb-4">
                            <label for="note" class="form-label">Ghi chú đơn hàng</label>
                            <textarea id="note" name="note" class="form-control" rows="2" placeholder="Ghi chú thêm (tùy chọn)" style="border: 1px solid #e0e0e0;">{{ old('note') }}</textarea>
                        </div>

                        <!-- Payment Method -->
                        <div class="alert alert-info" style="background: #d1ecf1; border: 1px solid #bee5eb; border-radius: 8px;">
                            <i class="fas fa-money-bill-wave"></i> <strong>Phương thức thanh toán:</strong> Thanh toán khi nhận hàng (COD)
                        </div>

                        <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 600; padding: 14px; border-radius: 8px; border: none; font-size: 1.05rem;">
                            <i class="fas fa-check-circle"></i> Đặt hàng ngay
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; position: sticky; top: 80px;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px 12px 0 0;">
                    <h5 style="margin: 0; font-weight: 700;"><i class="fas fa-receipt"></i> Đơn hàng của bạn</h5>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <!-- Cart Items -->
                    <div style="max-height: 400px; overflow-y: auto;">
                        @foreach($cartItems as $item)
                            <div style="padding: 12px 0; border-bottom: 1px solid #e0e0e0;">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong style="color: #333;">{{ $item->product->name }}</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">
                                        <i class="fas fa-tag"></i> {{ number_format($item->product->price, 0, ',', '.') }}₫ × {{ $item->quantity }}
                                    </small>
                                    <strong style="color: #f093fb;">{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}₫</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr style="border: 1px dashed #e0e0e0; margin: 1rem 0;">

                    <!-- Cost Summary -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #666;">Tạm tính:</span>
                            <span style="color: #333; font-weight: 600;">{{ number_format($total, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span style="color: #666;">Vận chuyển:</span>
                            <strong style="color: #28a745;">Miễn phí</strong>
                        </div>
                    </div>

                    <hr style="border: 1px solid #e0e0e0; margin: 1rem 0;">

                    <!-- Total -->
                    <div class="d-flex justify-content-between">
                        <span style="font-weight: 700; font-size: 1.1rem;">Tổng cộng:</span>
                        <strong style="font-size: 1.3rem; color: #f093fb;">{{ number_format($total, 0, ',', '.') }}₫</strong>
                    </div>

                    <!-- Info -->
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-top: 1rem; font-size: 0.9rem; color: #666;">
                        <i class="fas fa-info-circle" style="color: #667eea;"></i> Bạn sẽ thanh toán khi nhận được hàng
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection