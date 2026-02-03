@extends('layouts.app')

@section('title')Tìm kiếm: {{ $keyword }} - Fashion Shop@endsection

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #667eea; text-decoration: none;"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Kết quả tìm kiếm</li>
        </ol>
    </nav>

    <h1 class="section-title mb-4"><i class="fas fa-search"></i> Kết quả cho "{{ $keyword }}"</h1>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card h-100">
                    <a href="{{ route('product', $product->slug) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset($product->image) }}" class="product-image w-100" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body">
                        <span class="category-badge">{{ $product->category->name }}</span>
                        <h5 class="card-title" style="min-height: 3rem;">
                            <a href="{{ route('product', $product->slug) }}" class="text-decoration-none text-dark">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <p class="product-price">{{ number_format($product->price, 0, ',', '.') }}₫</p>
                        <p class="text-muted" style="font-size: 0.9rem;">Còn lại: <strong>{{ $product->quantity }}</strong></p>
                        @if($product->quantity > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary w-100" disabled>
                                <i class="fas fa-ban"></i> Hết hàng
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <h4 class="mt-3">Không tìm thấy sản phẩm</h4>
                    <p class="text-muted">Hãy thử từ khóa khác</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="row mt-5 mb-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
