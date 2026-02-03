<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Fashion Shop - Cửa Hàng Thời Trang')</title>
    
    <!-- Bootstrap CSS 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --light-bg: #f8f9fa;
            --border-color: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: #333;
            overflow-x: hidden;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: 0.5px;
            color: white !important;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .navbar .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            margin: 0 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar .nav-link:hover {
            color: white !important;
        }

        .navbar .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: white;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }

        .navbar .nav-link:hover::after {
            width: 80%;
        }

        .nav-link.active {
            color: white !important;
        }

        /* SEARCH FORM */
        .search-form {
            margin: 0 15px;
            flex: 1;
            max-width: 400px;
        }

        .search-form .input-group {
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .search-form input {
            border: none;
            padding: 10px 20px;
            background: white;
        }

        .search-form .btn {
            background: var(--accent-color);
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
        }

        .search-form .btn:hover {
            background: #f073e6;
            color: white;
        }

        /* CART BADGE */
        .cart-icon {
            position: relative;
            font-size: 1.2rem;
            transition: transform 0.3s;
        }

        .cart-icon:hover {
            transform: scale(1.1);
        }

        .badge-cart {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff6b6b;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
        }

        /* MAIN CONTENT */
        main {
            min-height: calc(100vh - 200px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* PRODUCT CARD */
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--border-color);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
            border-color: var(--primary-color);
        }

        .product-image {
            height: 250px;
            object-fit: cover;
            background: var(--light-bg);
            position: relative;
            overflow: hidden;
        }

        .product-image:hover {
            opacity: 0.95;
        }

        .product-card .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.25rem;
        }

        .category-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 10px;
            width: fit-content;
        }

        .product-card .card-title {
            font-weight: 600;
            font-size: 1rem;
            margin: 8px 0;
            color: #333;
        }

        .product-card .card-title a {
            color: inherit;
            text-decoration: none;
        }

        .product-card .card-title a:hover {
            color: var(--primary-color);
        }

        .product-price {
            color: var(--accent-color);
            font-size: 1.4rem;
            font-weight: 700;
            margin: 8px 0;
        }

        .product-card .btn {
            margin-top: auto;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        /* FORMS */
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        /* ALERTS */
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
        }

        /* BADGES */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* FOOTER */
        footer {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        footer h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: white;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.2);
            margin-top: 2rem;
            padding-top: 2rem;
            text-align: center;
            font-size: 0.95rem;
        }

        /* PAGINATION */
        .pagination {
            gap: 5px;
        }

        .page-link {
            color: var(--primary-color);
            border: 1px solid var(--border-color);
            border-radius: 6px;
        }

        .page-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .search-form {
                max-width: 100%;
                margin: 10px 0 0 0;
            }

            .product-image {
                height: 200px;
            }

            .product-card {
                margin-bottom: 15px;
            }

            .container {
                padding: 0 15px;
            }

            footer {
                padding: 2rem 0 1rem;
            }
        }

        /* BREADCRUMB */
        .breadcrumb {
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 10px 15px;
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* SECTION TITLES */
        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #333;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* LOADING SPINNER */
        .spinner-border {
            color: var(--primary-color);
        }

        /* TABLE */
        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background 0.3s;
        }

        .table tbody tr:hover {
            background: var(--light-bg);
        }

        /* CARD */
        .card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            color: white;
            font-weight: 600;
            border: none;
        }

        /* DROPDOWN */
        .dropdown-menu {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .dropdown-item:hover {
            background: var(--light-bg);
            color: var(--primary-color);
        }

        .dropdown-item.active {
            background: var(--primary-color);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-shopping-bag"></i> Fashion Shop
            </a>

            <!-- Search Form -->
            <form class="search-form d-none d-lg-flex" method="GET" action="{{ route('search') }}">
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" placeholder="Tìm sản phẩm..." value="{{ request('keyword') ?? '' }}">
                    <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        <i class="fas fa-history"></i> Đơn hàng của tôi
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-edit"></i> Thông tin cá nhân
                                    </a>
                                </li>
                                @if(Auth::user()->isAdmin())
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-chart-line"></i> Admin Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Đăng nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Đăng ký
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @if ($errors->any())
            <div class="container mb-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <strong>Lỗi!</strong>
                    <ul class="mb-0 ms-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="container mb-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container mb-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-times-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4">
                    <h5><i class="fas fa-store"></i> Fashion Shop</h5>
                    <p>Cửa hàng thời trang online hàng đầu Việt Nam với hàng ngàn sản phẩm chất lượng.</p>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <h5>Liên kết nhanh</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="{{ route('cart.index') }}">Giỏ hàng</a></li>
                        @auth
                            <li><a href="{{ route('orders.index') }}">Đơn hàng của tôi</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <h5>Hỗ trợ khách hàng</h5>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-phone"></i> 1800.xxxx</a></li>
                        <li><a href="#"><i class="fas fa-envelope"></i> support@fashionshop.vn</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Điều khoản sử dụng</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <h5>Kết nối với chúng tôi</h5>
                    <div>
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Fashion Shop. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>