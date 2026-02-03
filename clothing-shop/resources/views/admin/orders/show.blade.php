@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-shopping-bag"></i> Chi tiết đơn hàng #{{ $order->id }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="row">
        <!-- Order Info -->
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Thông tin đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Mã đơn hàng:</strong> <span class="badge bg-info">#{{ $order->id }}</span></p>
                            <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
                            <p><strong>Email:</strong> {{ $order->customer_email ?? 'Không có' }}</p>
                            <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Địa chỉ giao hàng:</strong></p>
                            <p class="ms-3">{{ $order->customer_address }}</p>
                            @if($order->note)
                                <p><strong>Ghi chú:</strong></p>
                                <p class="ms-3">{{ $order->note }}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
                            <p><strong>Cập nhật:</strong> {{ $order->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                        <div class="col-md-6">
                            @if($order->user)
                                <p><strong>Tài khoản:</strong> {{ $order->user->email }}</p>
                            @else
                                <p><strong>Loại khách:</strong> Khách vãng lai</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-box"></i> Sản phẩm đã đặt</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-end">Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $detail)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($detail->product->image)
                                                    <img src="{{ asset($detail->product->image) }}" width="50" height="50" class="me-3 rounded" style="object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $detail->product->name }}</strong><br>
                                                    <small class="text-muted">SKU: #{{ $detail->product->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">{{ number_format($detail->price, 0, ',', '.') }}₫</td>
                                        <td class="text-center">{{ $detail->quantity }}</td>
                                        <td class="text-end"><strong>{{ number_format($detail->subtotal, 0, ',', '.') }}₫</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-active fw-bold">
                                    <td colspan="3" class="text-end">Tổng cộng:</td>
                                    <td class="text-end text-danger fs-5">{{ number_format($order->total_money, 0, ',', '.') }}₫</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Status & Actions -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header bg-warning">
                    <h5 class="mb-0"><i class="fas fa-flag"></i> Trạng thái đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        @if($order->status === 'pending')
                            <span class="badge bg-warning p-3 fs-6 w-100">Chờ duyệt</span>
                        @elseif($order->status === 'processing')
                            <span class="badge bg-info p-3 fs-6 w-100">Đang giao</span>
                        @elseif($order->status === 'completed')
                            <span class="badge bg-success p-3 fs-6 w-100">Hoàn thành</span>
                        @elseif($order->status === 'cancelled')
                            <span class="badge bg-danger p-3 fs-6 w-100">Đã hủy</span>
                        @endif
                    </div>

                    @if($order->status !== 'cancelled')
                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Cập nhật trạng thái:</label>
                                <select name="status" class="form-select">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Đang giao</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Lịch sử</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="mb-3">
                            <i class="fas fa-circle-check text-success me-2"></i>
                            <strong>Đơn hàng được tạo</strong>
                            <br><small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        
                        @if($order->status !== 'pending')
                            <div class="mb-3">
                                <i class="fas fa-truck text-info me-2"></i>
                                <strong>Đang xử lý / Giao hàng</strong>
                                <br><small class="text-muted">{{ $order->updated_at->format('d/m/Y H:i') }}</small>
                            </div>
                        @endif

                        @if($order->status === 'completed')
                            <div class="mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Hoàn thành</strong>
                                <br><small class="text-muted">{{ $order->updated_at->format('d/m/Y H:i') }}</small>
                            </div>
                        @endif

                        @if($order->status === 'cancelled')
                            <div class="mb-3">
                                <i class="fas fa-times-circle text-danger me-2"></i>
                                <strong>Đã hủy</strong>
                                <br><small class="text-muted">{{ $order->updated_at->format('d/m/Y H:i') }}</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($order->status === 'cancelled')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                                <i class="fas fa-trash"></i> Xóa đơn hàng
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
