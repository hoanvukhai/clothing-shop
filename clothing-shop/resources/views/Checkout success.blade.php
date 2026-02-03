@extends('layouts.app')

@section('title', 'Đặt hàng thành công - Fashion Shop')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    <h2 class="mt-3 mb-3">Đặt hàng thành công!</h2>
                    <p class="lead">Cảm ơn bạn đã đặt hàng tại Fashion Shop</p>
                    <p>Mã đơn hàng của bạn: <strong>#{{ $order->id }}</strong></p>
                    <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</p>
                    
                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle"></i> 
                        Đơn hàng của bạn đang được xử lý. 
                        Bạn sẽ nhận được thông báo khi đơn hàng được giao.
                    </div>

                    <hr>

                    <h5 class="mb-3">Thông tin đơn hàng</h5>
                    <div class="text-start">
                        <p><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                        <p><strong>Tổng tiền:</strong> <span class="text-danger fs-5">{{ number_format($order->total_money, 0, ',', '.') }}₫</span></p>
                    </div>

                    <hr>

                    <h5 class="mb-3">Chi tiết sản phẩm</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $detail)
                                <tr>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>{{ number_format($detail->price, 0, ',', '.') }}₫</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ number_format($detail->subtotal, 0, ',', '.') }}₫</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-home"></i> Về trang chủ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection