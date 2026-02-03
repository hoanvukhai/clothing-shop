@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard</h2>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Tổng đơn hàng</h6>
                            <h2 class="mb-0">{{ $totalOrders }}</h2>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Doanh thu</h6>
                            <h2 class="mb-0">{{ number_format($totalRevenue, 0, ',', '.') }}₫</h2>
                        </div>
                        <i class="fas fa-dollar-sign fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Sản phẩm</h6>
                            <h2 class="mb-0">{{ $totalProducts }}</h2>
                        </div>
                        <i class="fas fa-box fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Đơn chờ duyệt</h6>
                            <h2 class="mb-0">{{ $pendingOrders }}</h2>
                        </div>
                        <i class="fas fa-clock fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Doanh thu 7 ngày gần đây</h5>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Sản phẩm bán chạy</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($topProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->name }}
                                <span class="badge bg-primary rounded-pill">{{ $product->total_sold ?? 0 }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Đơn hàng mới nhất</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">Xem tất cả</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td><a href="{{ route('admin.orders.show', $order->id) }}">#{{ $order->id }}</a></td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ number_format($order->total_money, 0, ',', '.') }}₫</td>
                                    <td><span class="badge bg-{{ $order->status_badge }}">{{ $order->status_name }}</span></td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueData = @json($revenueChart);
    
    const labels = revenueData.map(item => {
        const date = new Date(item.date);
        return date.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' });
    });
    
    const data = revenueData.map(item => item.total);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: data,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + '₫';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection