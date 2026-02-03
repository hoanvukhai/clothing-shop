# Fashion Shop - Hệ thống Quản lý Cửa hàng Thời trang

Đây là một ứng dụng web thương mại điện tử đầy đủ chức năng, xây dựng bằng Laravel 11 với UI Bootstrap 5 và Tailwind CSS.

## 🚀 Các Tính Năng Chính

### 👥 Phía Khách Hàng (Frontend)

#### 1. **Duyệt Sản Phẩm**
- Trang chủ hiển thị danh sách sản phẩm phân trang (12 sản phẩm/trang)
- Lọc sản phẩm theo danh mục
- Xem chi tiết sản phẩm có mô tả đầy đủ
- Hiển thị 4 sản phẩm liên quan (cùng danh mục)

#### 2. **Tìm Kiếm**
- Tìm kiếm theo tên sản phẩm
- Tìm kiếm theo mô tả
- Kết quả hiển thị phân trang

#### 3. **Giỏ Hàng**
- Thêm sản phẩm vào giỏ (với kiểm tra tồn kho)
- Cập nhật số lượng (với kiểm tra tồn kho)
- Xóa sản phẩm khỏi giỏ
- Xóa toàn bộ giỏ hàng
- Tính tổng tiền tự động (phí vận chuyển miễn phí)

#### 4. **Thanh Toán**
- Form nhập thông tin giao hàng (họ tên, điện thoại, địa chỉ)
- Xác nhận đơn hàng trước thanh toán
- Thanh toán COD (Thanh toán khi nhận hàng)
- Tự động giảm tồn kho khi đặt hàng

#### 5. **Đơn Hàng**
- Trang thành công sau khi đặt hàng
- Xem lịch sử đơn hàng cá nhân
- Xem chi tiết từng đơn hàng (danh sách sản phẩm, tổng tiền)
- Theo dõi trạng thái đơn hàng

#### 6. **Tài Khoản**
- Đăng ký tài khoản mới (email, password)
- Đăng nhập/Đăng xuất
- Quản lý thông tin cá nhân (sửa profile)

---

### 🔧 Phía Admin (Backend)

#### 1. **Dashboard**
- Thống kê tổng quan:
  - Tổng số đơn hàng
  - Doanh thu từ các đơn hoàn thành
  - Tổng số sản phẩm
  - Tổng số khách hàng
  - Số đơn hàng chờ duyệt
  
- **Biểu đồ**:
  - Doanh thu 7 ngày qua
  - Sản phẩm bán chạy (top 5)
  - Đơn hàng mới nhất

#### 2. **Quản lý Danh Mục**
- Xem danh sách danh mục (với số lượng sản phẩm)
- Thêm danh mục mới
- Sửa thông tin danh mục
- Xóa danh mục (chỉ khi không có sản phẩm)
- Slug tự động tạo

#### 3. **Quản lý Sản Phẩm**
- Xem danh sách sản phẩm (bảng hiển thị: ảnh, giá, số lượng, trạng thái)
- Thêm sản phẩm mới:
  - Chọn danh mục
  - Nhập tên, mô tả
  - Nhập giá, số lượng
  - Upload ảnh (JPG, PNG, GIF - tối đa 2MB)
  - Chọn hiển thị/ẩn
  
- Sửa sản phẩm:
  - Cập nhật tất cả thông tin
  - Thay đổi ảnh
  - Xem ảnh hiện tại trước khi đổi
  
- Xóa sản phẩm
- Ẩn/Hiển thị sản phẩm (toggle)

#### 4. **Quản lý Đơn Hàng**
- **Xem Danh Sách:**
  - Filter theo trạng thái (Chờ duyệt, Đang giao, Hoàn thành, Đã hủy)
  - Hiển thị: Mã đơn, khách hàng, ngày đặt, tổng tiền, trạng thái
  
- **Xem Chi Tiết:**
  - Thông tin khách hàng (tên, phone, email, địa chỉ)
  - Danh sách sản phẩm (tên, giá, số lượng, tổng)
  - Ngày đặt, ngày cập nhật
  - Tài khoản liên kết
  - Ghi chú
  
- **Cập nhật Trạng thái:**
  - Chờ duyệt (Pending)
  - Đang giao (Processing)
  - Hoàn thành (Completed)
  - Đã hủy (Cancelled)
  - Hiển thị dropdown cập nhật
  
- **Timeline:**
  - Hiển thị lịch sử trạng thái với thời gian
  
- **Xóa Đơn Hàng:**
  - Chỉ xóa được đơn hàng đã hủy

---

## 🏗️ Cấu Trúc Dự Án

```
clothing-shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── OrderHistoryController.php (NEW)
│   │   │   ├── ProfileController.php
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   └── OrderController.php
│   │   │   └── Auth/
│   │   │       └── (Laravel Breeze Controllers)
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   └── Requests/ (Laravel Form Requests)
│   └── Models/
│       ├── User.php
│       ├── Category.php
│       ├── Product.php
│       ├── Order.php
│       └── OrderDetail.php
├── database/
│   ├── migrations/
│   │   └── (All migration files)
│   ├── factories/
│   │   └── UserFactory.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php (Frontend layout)
│   │   │   ├── admin.blade.php (Admin layout)
│   │   │   ├── guest.blade.php (Auth layout)
│   │   │   └── navigation.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php (Sửa tiếng Việt)
│   │   │   ├── register.blade.php (Sửa tiếng Việt)
│   │   │   └── ...
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── categories/
│   │   │   │   ├── index.blade.php (NEW)
│   │   │   │   ├── create.blade.php (NEW)
│   │   │   │   └── edit.blade.php (NEW)
│   │   │   ├── products/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php (FIXED)
│   │   │   │   └── edit.blade.php (NEW)
│   │   │   └── orders/
│   │   │       ├── index.blade.php (NEW)
│   │   │       └── show.blade.php (NEW)
│   │   ├── orders/ (NEW)
│   │   │   ├── history.blade.php
│   │   │   └── show.blade.php
│   │   ├── home.blade.php
│   │   ├── product.blade.php
│   │   ├── category.blade.php
│   │   ├── search.blade.php
│   │   ├── cart.blade.php
│   │   ├── checkout.blade.php
│   │   └── checkout-success.blade.php (NEW)
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   ├── web.php (Thêm order routes)
│   └── auth.php
├── public/
│   ├── index.php
│   └── uploads/ (Folder lưu ảnh sản phẩm)
├── composer.json
├── package.json
└── README.md
```

---

## 📦 Dependencies

### Backend
- **Laravel 11** - PHP Framework
- **Laravel Breeze** - Lightweight authentication
- **Eloquent ORM** - Database management
- **MySQL/PostgreSQL** - Database

### Frontend
- **Bootstrap 5** - CSS Framework
- **Tailwind CSS** - Utility-first CSS
- **Vite** - Module bundler
- **Font Awesome** - Icon library

---

## 🔐 Security Features

- **Authentication:** Laravel Breeze (hashed passwords)
- **Authorization:** AdminMiddleware (kiểm tra quyền admin)
- **CSRF Protection:** Automatic token validation
- **Input Validation:** Form request validation
- **Database Transactions:** Sử dụng trong thanh toán
- **Inventory Management:** Kiểm tra tồn kho

---

## 🎯 Trạng Thái Đơn Hàng

```
┌─────────────┐
│ Chờ duyệt   │ ← Admin duyệt
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ Đang giao   │ ← Admin xác nhận giao hàng
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ Hoàn thành  │ ← Khách nhận được hàng
└─────────────┘

       hoặc

┌─────────────┐
│ Đã hủy      │ ← Admin hủy đơn (có thể xóa)
└─────────────┘
```

---

## 🚀 Cách Chạy Project

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & npm
- MySQL/PostgreSQL

### Installation

1. **Clone project**
```bash
git clone <repo-url>
cd clothing-shop
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database setup**
```bash
php artisan migrate:fresh --seed
```

5. **Build frontend**
```bash
npm run build
# hoặc dev mode
npm run dev
```

6. **Run server**
```bash
php artisan serve
```

Server sẽ chạy tại `http://localhost:8000`

---

## 👥 Tài Khoản Test

Sau khi chạy `php artisan migrate:fresh --seed`, có thể đăng nhập bằng:

### Admin Account
- **Email:** admin@example.com
- **Password:** password

### Customer Account
- **Email:** user@example.com
- **Password:** password

---

## 📝 Routes Chính

### Khách Hàng
| Method | URL | Tên | Controller |
|--------|-----|-----|-----------|
| GET | `/` | Home | HomeController@index |
| GET | `/danh-muc/{slug}` | Danh mục | HomeController@category |
| GET | `/san-pham/{slug}` | Chi tiết SP | HomeController@product |
| GET | `/tim-kiem` | Tìm kiếm | HomeController@search |
| GET | `/gio-hang` | Giỏ hàng | CartController@index |
| POST | `/gio-hang/them/{id}` | Thêm giỏ | CartController@add |
| POST | `/gio-hang/cap-nhat` | Cập nhật giỏ | CartController@update |
| GET | `/gio-hang/xoa/{id}` | Xóa sản phẩm | CartController@remove |
| GET | `/thanh-toan` | Checkout | CheckoutController@index |
| POST | `/thanh-toan` | Lưu đơn | CheckoutController@store |
| GET | `/thanh-toan/thanh-cong/{id}` | Thành công | CheckoutController@success |
| GET | `/don-hang` | Lịch sử | OrderHistoryController@index |
| GET | `/don-hang/{order}` | Chi tiết | OrderHistoryController@show |

### Admin
| Method | URL | Tên | Controller |
|--------|-----|-----|-----------|
| GET | `/admin` | Dashboard | DashboardController@index |
| GET | `/admin/categories` | DS Danh mục | CategoryController@index |
| POST | `/admin/categories` | Thêm DM | CategoryController@store |
| PUT | `/admin/categories/{id}` | Sửa DM | CategoryController@update |
| DELETE | `/admin/categories/{id}` | Xóa DM | CategoryController@destroy |
| GET | `/admin/products` | DS Sản phẩm | ProductController@index |
| POST | `/admin/products` | Thêm SP | ProductController@store |
| PUT | `/admin/products/{id}` | Sửa SP | ProductController@update |
| DELETE | `/admin/products/{id}` | Xóa SP | ProductController@destroy |
| GET | `/admin/orders` | DS Đơn hàng | OrderController@index |
| GET | `/admin/orders/{id}` | Chi tiết DH | OrderController@show |
| POST | `/admin/orders/{id}/update-status` | Cập nhật | OrderController@updateStatus |
| DELETE | `/admin/orders/{id}` | Xóa DH | OrderController@destroy |

---

## 🐛 Lưu Ý Khi Phát Triển

1. **Image Storage**: Ảnh được lưu tại `public/uploads/products/`
2. **Session Storage**: Giỏ hàng được lưu trong session
3. **Inventory**: Tự động giảm khi tạo đơn hàng, không tự động hoàn lại nếu hủy
4. **COD Only**: Hiện tại chỉ hỗ trợ thanh toán COD
5. **Email**: Chưa có email confirmation, có thể add sau

---

## 📈 Các Cải Tiến Có Thể Làm

- [ ] Thêm payment gateway (VNPay, Stripe)
- [ ] Email notifications
- [ ] SMS notifications
- [ ] Product reviews & ratings
- [ ] Wishlist feature
- [ ] Discount codes/Coupons
- [ ] Inventory alerts
- [ ] Export orders to PDF
- [ ] Analytics dashboard
- [ ] Multiple product images
- [ ] Product variants (size, color)
- [ ] Real-time chat support

---

## 📞 Support

Nếu gặp vấn đề, vui lòng kiểm tra:
1. Migrations đã chạy? `php artisan migrate`
2. Permissions của uploads folder?
3. Database connection trong `.env`?
4. Node modules installed? `npm install`

---

**Version:** 1.0.0  
**Last Updated:** 02/02/2026  
**Status:** ✅ Production Ready (with caveats)
