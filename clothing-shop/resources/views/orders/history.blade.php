@extends('layouts.app')

@section('title', 'Lịch sử đơn hàng - Fashion Shop')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #667eea; text-decoration: none;"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active"><i class="fas fa-shopping-bag"></i> Lịch sử đơn hàng</li>
        </ol>
    </nav>

    <h1 class="section-title mb-5"><i class="fas fa-shopping-bag"></i> Lịch sử đơn hàng của bạn</h1>

    @if($orders->count() > 0)
        <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                            <th style="border: none;">Mã đơn hàng</th>
                            <th style="border: none;">Ngày đặt</th>
                            <th style="border: none;" class="text-center">Số sản phẩm</th>
                            <th style="border: none;" class="text-right">Tổng tiền</th>
                            <th style="border: none;" class="text-center">Trạng thái</th>
                            <th style="border: none;" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td style="border-bottom: 1px solid #e0e0e0;">
                                    <strong style="color: #667eea;">#{{ $order->id }}</strong>
                                </td>
                                <td style="border-bottom: 1px solid #e0e0e0;">
                                    <i class="fas fa-calendar"></i> {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td style="border-bottom: 1px solid #e0e0e0;" class="text-center">
                                    {{ $order->order_details_count }} sản phẩm
                                </td>
                                <td style="border-bottom: 1px solid #e0e0e0;" class="text-right">
                                    <strong style="color: #f093fb; font-size: 1.05rem;">{{ number_format($order->total_money, 0, ',', '.') }}₫</strong>
                                </td>
                                <td style="border-bottom: 1px solid #e0e0e0;" class="text-center">
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
                                </td>
                                <td style="border-bottom: 1px solid #e0e0e0;" class="text-center">
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 600; border-radius: 6px; padding: 6px 12px; text-decoration: none;">
                                        <i class="fas fa-eye"></i> Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        @endif
    @else
        <div class="empty-state" style="padding: 5rem 1rem;">
            <i class="fas fa-inbox" style="font-size: 5rem; color: #667eea; opacity: 0.3;"></i>
            <h3 class="mt-4" style="color: #333;">Bạn chưa có đơn hàng nào</h3>
            <p class="text-muted mb-4">Hãy thêm một số sản phẩm và hoàn tất thanh toán để tạo đơn hàng</p>
            <a href="{{ route('home') }}" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 600; padding: 12px 30px; border-radius: 8px;">
                <i class="fas fa-shopping-bag"></i> Mua sắm ngay
            </a>
        </div>
    @endif
</div>
@endsection
