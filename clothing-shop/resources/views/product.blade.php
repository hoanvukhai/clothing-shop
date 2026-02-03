@extends('layouts.app')

@section('title'){{ $product->name }} - Fashion Shop@endsection

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #667eea; text-decoration: none;"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category', $product->category->slug) }}" style="color: #667eea; text-decoration: none;">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row mb-5">
        <!-- Product Image -->
        <div class="col-lg-6 mb-4">
            <div class="card" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="width: 100%; height: 500px; object-fit: cover;">
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="mb-4">
                <span class="category-badge">{{ $product->category->name }}</span>
            </div>

            <h1 style="font-weight: 700; color: #333; font-size: 2rem; margin-bottom: 1rem;">{{ $product->name }}</h1>

            <!-- Price -->
            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 8px; margin-bottom: 2rem;">
                <p style="color: #666; margin: 0; margin-bottom: 8px;">Giá bán</p>
                <p class="product-price" style="margin: 0; font-size: 2.5rem;">{{ number_format($product->price, 0, ',', '.') }}₫</p>
            </div>

            <!-- Stock Info -->
            <div class="mb-4">
                @if($product->quantity > 0)
                    <div style="padding: 1rem; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 8px;">
                        <i class="fas fa-check-circle" style="color: #155724;"></i>
                        <strong style="color: #155724;">Còn hàng</strong> - {{ $product->quantity }} sản phẩm có sẵn
                    </div>
                @else
                    <div style="padding: 1rem; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px;">
                        <i class="fas fa-times-circle" style="color: #721c24;"></i>
                        <strong style="color: #721c24;">Hết hàng</strong>
                    </div>
                @endif
            </div>

            <!-- Description -->
            @if($product->description)
                <div class="mb-4">
                    <h5 style="font-weight: 700; color: #333; margin-bottom: 1rem;">Mô tả sản phẩm</h5>
                    <p style="color: #666; line-height: 1.6;">{{ $product->description }}</p>
                </div>
            @endif

            <!-- Add to Cart -->
            @if($product->quantity > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 600; padding: 14px; border-radius: 8px; border: none; font-size: 1.05rem; margin-bottom: 12px;">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </form>
            @endif

            <!-- Back & Continue Shopping -->
            <div class="row gap-2">
                <div class="col-6">
                    <a href="{{ route('home') }}" class="btn w-100" style="background: white; border: 2px solid #667eea; color: #667eea; font-weight: 600; padding: 12px; border-radius: 8px;">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('cart.index') }}" class="btn w-100" style="background: #667eea; color: white; font-weight: 600; padding: 12px; border-radius: 8px; border: none;">
                        <i class="fas fa-shopping-cart"></i> Giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <hr style="margin: 3rem 0;">
        <h2 class="section-title">Sản phẩm liên quan</h2>
        
        <div class="row g-4">
            @foreach($relatedProducts->take(4) as $relProduct)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card h-100">
                        <a href="{{ route('product', $relProduct->slug) }}" style="text-decoration: none; color: inherit;">
                            <img src="{{ asset($relProduct->image) }}" class="product-image w-100" alt="{{ $relProduct->name }}">
                        </a>
                        <div class="card-body">
                            <span class="category-badge">{{ $relProduct->category->name }}</span>
                            <h5 class="card-title" style="min-height: 3rem;">
                                <a href="{{ route('product', $relProduct->slug) }}" class="text-decoration-none text-dark">
                                    {{ $relProduct->name }}
                                </a>
                            </h5>
                            <p class="product-price">
                                {{ number_format($relProduct->price, 0, ',', '.') }}₫
                            </p>
                            @if($relProduct->quantity > 0)
                                <form action="{{ route('cart.add', $relProduct->id) }}" method="POST">
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
            @endforeach
        </div>
    @endif
</div>
@endsection