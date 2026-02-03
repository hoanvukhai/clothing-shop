@extends('layouts.app')

@section('title', 'Giỏ hàng - Fashion Shop')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #667eea; text-decoration: none;"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active"><i class="fas fa-shopping-cart"></i> Giỏ hàng</li>
        </ol>
    </nav>

    <h1 class="section-title mb-5">
        <i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn
    </h1>

    @if($cartItems->count() > 0)
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8 mb-4">
                <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                    <th style="border: none;">Sản phẩm</th>
                                    <th style="border: none;" class="text-center">Giá</th>
                                    <th style="border: none;" class="text-center">Số lượng</th>
                                    <th style="border: none;" class="text-right">Thành tiền</th>
                                    <th style="border: none;" class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    @php $itemTotal = $item->product->price * $item->quantity; @endphp
                                    <tr>
                                        <td style="border-bottom: 1px solid #e0e0e0;">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; margin-right: 15px;">
                                                <div>
                                                    <h6 class="mb-0" style="font-weight: 600;">{{ $item->product->name }}</h6>
                                                    <small class="text-muted">{{ $item->product->category->name ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-bottom: 1px solid #e0e0e0;" class="text-center">
                                            <span style="color: #667eea; font-weight: 600;">{{ number_format($item->product->price, 0, ',', '.') }}₫</span>
                                        </td>
                                        <td style="border-bottom: 1px solid #e0e0e0;" class="text-center">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex justify-content-center cart-update-form">
                                                @csrf
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px; text-align: center; border: 1px solid #e0e0e0; border-radius: 6px; padding: 5px;">
                                                <button type="submit" class="btn btn-sm btn-primary ms-2">Cập nhật</button>
                                            </form>
                                        </td>
                                        <td style="border-bottom: 1px solid #e0e0e0;" class="text-right">
                                            <span class="item-total" style="font-weight: 700; font-size: 1.1rem; color: #f093fb;">{{ number_format($itemTotal, 0, ',', '.') }}₫</span>
                                        </td>
                                        <td style="border-bottom: 1px solid #e0e0e0;" class="text-center">
                                            <form action="{{ route('cart.remove', $item->product->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa" style="border-radius: 6px;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Continue Shopping -->
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary" style="border-radius: 8px; padding: 12px 30px;">
                        <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); position: sticky; top: 80px;">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px 12px 0 0;">
                        <h5 style="margin: 0; font-weight: 700;"><i class="fas fa-receipt"></i> Tóm tắt đơn hàng</h5>
                    </div>
                    <div class="card-body" style="padding: 1.5rem;">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tạm tính:</span>
                            <strong>{{ number_format($total, 0, ',', '.') }}₫</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Vận chuyển:</span>
                            <strong style="color: #28a745;">Miễn phí</strong>
                        </div>
                        <hr style="border: 1px dashed #e0e0e0;">
                        <div class="d-flex justify-content-between mb-4">
                            <span style="font-weight: 700; font-size: 1.1rem;">Tổng cộng:</span>
                            <strong id="cart-total" style="font-size: 1.3rem; color: #f093fb;">{{ number_format($total, 0, ',', '.') }}₫</strong>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 600; padding: 12px; border-radius: 8px; border: none;">
                            <i class="fas fa-credit-card"></i> Thanh toán
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="empty-state" style="padding: 5rem 1rem;">
                    <i class="fas fa-shopping-bag" style="font-size: 5rem; color: #667eea; opacity: 0.3;"></i>
                    <h3 class="mt-4" style="color: #333;">Giỏ hàng của bạn đang trống</h3>
                    <p class="text-muted mb-4">Hãy thêm một số sản phẩm để bắt đầu mua sắm</p>
                    <a href="{{ route('home') }}" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 600; padding: 12px 30px; border-radius: 8px;">
                        <i class="fas fa-arrow-left"></i> Quay lại trang chủ
                    </a>
                </div>
            </div>
        </div>
    @endif
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.cart-update-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const url = this.action;
            const row = this.closest('tr');

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    row.querySelector('.item-total').textContent = data.itemTotal;
                    document.getElementById('cart-total').textContent = data.total;
                }
            }).catch(error => console.error('Error:', error));
        });
    });
});
</script>
@endpush