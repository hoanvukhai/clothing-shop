@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-shopping-bag"></i> Quản lý đơn hàng</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Filter -->
            <form method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                            <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Đang giao</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><strong>#{{ $order->id }}</strong></td>
                                    <td>
                                        <div>{{ $order->customer_name }}</div>
                                        <small class="text-muted">{{ $order->customer_phone }}</small>
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-danger fw-bold">{{ number_format($order->total_money, 0, ',', '.') }}₫</td>
                                    <td>
                                        @if($order->status === 'pending')
                                            <span class="badge bg-warning">Chờ duyệt</span>
                                        @elseif($order->status === 'processing')
                                            <span class="badge bg-info">Đang giao</span>
                                        @elseif($order->status === 'completed')
                                            <span class="badge bg-success">Hoàn thành</span>
                                        @elseif($order->status === 'cancelled')
                                            <span class="badge bg-danger">Đã hủy</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Xem
                                        </a>
                                        @if($order->status !== 'cancelled')
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fas fa-edit"></i> Trạng thái
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="pending">
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Cập nhật trạng thái?')">
                                                                <i class="fas fa-clock"></i> Chờ duyệt
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="processing">
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Cập nhật trạng thái?')">
                                                                <i class="fas fa-truck"></i> Đang giao
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Cập nhật trạng thái?')">
                                                                <i class="fas fa-check-circle"></i> Hoàn thành
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Cập nhật trạng thái?')">
                                                                <i class="fas fa-ban"></i> Hủy
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                        @if($order->status === 'cancelled')
                                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa đơn hàng này?')">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation">
                    {{ $orders->links() }}
                </nav>
            @else
                <div class="alert alert-info text-center">
                    <i class="fas fa-inbox"></i> Chưa có đơn hàng nào
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
