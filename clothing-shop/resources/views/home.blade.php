@extends('layouts.app')

@section('title', 'Trang chủ - Fashion Shop')

@section('content')
<div class="container">
    <!-- Hero Banner -->
    <div class="row mb-5">
        <div class="col-12">
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px; padding: 4rem 2rem; text-align: center; color: white;">
                <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">Chào mừng đến Fashion Shop</h1>
                <p style="font-size: 1.1rem; margin-bottom: 0; opacity: 0.95;">Khám phá bộ sưu tập thời trang mới nhất từ các thương hiệu hàng đầu</p>
            </div>
        </div>
    </div>

    <!-- Search Form Mobile -->
    <div class="row mb-4 d-lg-none">
        <div class="col-12">
            <form method="GET" action="{{ route('search') }}" class="mb-4">
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" placeholder="Tìm sản phẩm..." value="{{ request('keyword') ?? '' }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Filter -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="section-title">Danh mục sản phẩm</h2>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('home') }}" class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }}" style="border-radius: 25px; padding: 10px 20px;">
                    <i class="fas fa-th-large"></i> Tất cả
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('category', $cat->slug) }}" class="btn btn-outline-primary" style="border-radius: 25px; padding: 10px 20px;">
                        <i class="fas fa-tag"></i> {{ $cat->name }} ({{ $cat->products_count }})
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="section-title">Sản phẩm nổi bật</h2>
        </div>
    </div>

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
                        <p class="product-price">
                            {{ number_format($product->price, 0, ',', '.') }}₫
                        </p>
                        <p class="text-muted" style="font-size: 0.9rem;">
                            <i class="fas fa-boxes"></i> Còn lại: <strong>{{ $product->quantity }}</strong>
                        </p>
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
                    <i class="fas fa-shopping-bag"></i>
                    <h4 class="mt-3">Không có sản phẩm</h4>
                    <p class="text-muted">Vui lòng quay lại sau</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row mt-5 mb-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection