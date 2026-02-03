# HƯỚNG DẪN CÀI ĐẶT VÀ CHẠY DỰ ÁN WEB BÁN QUẦN ÁO LARAVEL

## YÊU CẦU HỆ THỐNG
- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM (cho Laravel Breeze)

---

## BƯỚC 1: TẠO DỰ ÁN LARAVEL MỚI

```bash
# Tạo project Laravel
composer create-project laravel/laravel clothing-shop
cd clothing-shop

# Cài đặt Laravel Breeze cho authentication
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
```

---

## BƯỚC 2: CẤU HÌNH DATABASE

1. Tạo database trong MySQL:
```sql
CREATE DATABASE clothing_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Cấu hình file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clothing_shop
DB_USERNAME=root
DB_PASSWORD=
```

---

## BƯỚC 3: TẠO MIGRATION

Copy các file migration sau vào thư mục `database/migrations/`:

1. **xxxx_xx_xx_create_categories_table.php**
2. **xxxx_xx_xx_create_products_table.php**
3. **xxxx_xx_xx_create_orders_table.php**
4. **xxxx_xx_xx_create_order_details_table.php**
5. **xxxx_xx_xx_add_role_to_users_table.php**

Đặt tên file theo format: `YYYY_MM_DD_HHMMSS_tên_migration.php`

---

## BƯỚC 4: TẠO MODELS

Copy các file Model vào thư mục `app/Models/`:
- `Category.php`
- `Product.php`
- `Order.php`
- `OrderDetail.php`
- `User.php` (cập nhật file có sẵn)

---

## BƯỚC 5: TẠO MIDDLEWARE

1. Tạo middleware:
```bash
php artisan make:middleware AdminMiddleware
```

2. Copy nội dung file `AdminMiddleware.php` vào `app/Http/Middleware/AdminMiddleware.php`

3. Đăng ký middleware trong `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})
```

---

## BƯỚC 6: TẠO CONTROLLERS

Tạo các controllers:

```bash
# Admin Controllers
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/CategoryController --resource
php artisan make:controller Admin/ProductController --resource
php artisan make:controller Admin/OrderController

# Frontend Controllers
php artisan make:controller HomeController
php artisan make:controller CartController
php artisan make:controller CheckoutController
```

Copy nội dung các file controller đã tạo vào đúng vị trí.

---

## BƯỚC 7: TẠO ROUTES

Copy nội dung file `web.php` vào `routes/web.php`

---

## BƯỚC 8: TẠO VIEWS

Tạo cấu trúc thư mục views:

```
resources/views/
├── layouts/
│   ├── app.blade.php          (layout frontend)
│   └── admin.blade.php        (layout admin)
├── admin/
│   ├── dashboard.blade.php
│   ├── categories/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── products/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── orders/
│       ├── index.blade.php
│       └── show.blade.php
├── home.blade.php
├── category.blade.php
├── product.blade.php
├── search.blade.php
├── cart.blade.php
├── checkout.blade.php
└── checkout-success.blade.php
```

Copy nội dung các file blade đã tạo vào đúng vị trí.

---

## BƯỚC 9: TẠO SEEDER VÀ CHẠY MIGRATION

1. Copy file `DatabaseSeeder.php` vào `database/seeders/DatabaseSeeder.php`

2. Tạo thư mục uploads:
```bash
mkdir -p public/uploads/products
chmod -R 775 public/uploads
```

3. Chạy migration và seeder:
```bash
php artisan migrate:fresh --seed
```

---

## BƯỚC 10: CHẠY DỰ ÁN

```bash
# Chạy server
php artisan serve
```

Truy cập: http://localhost:8000

### THÔNG TIN ĐĂNG NHẬP:

**Admin:**
- Email: admin@example.com
- Password: admin123

**User:**
- Email: user@example.com
- Password: user123

---

## CẤU TRÚC DỰ ÁN

```
clothing-shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   └── OrderController.php
│   │   │   ├── HomeController.php
│   │   │   ├── CartController.php
│   │   │   └── CheckoutController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── Category.php
│       ├── Product.php
│       ├── Order.php
│       ├── OrderDetail.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       ├── admin/
│       └── (các view frontend)
├── routes/
│   └── web.php
└── public/
    └── uploads/
        └── products/
```

---

## CHỨC NĂNG CHÍNH

### Frontend (Khách hàng):
✅ Xem danh sách sản phẩm
✅ Xem chi tiết sản phẩm  
✅ Tìm kiếm sản phẩm
✅ Thêm vào giỏ hàng
✅ Quản lý giỏ hàng (thêm/sửa/xóa)
✅ Đặt hàng (Checkout)
✅ Đăng ký / Đăng nhập

### Backend (Admin):
✅ Dashboard với thống kê
✅ Quản lý danh mục (CRUD)
✅ Quản lý sản phẩm (CRUD + Upload ảnh)
✅ Quản lý đơn hàng (Xem, đổi trạng thái)
✅ Biểu đồ doanh thu

---

## LƯU Ý QUAN TRỌNG

1. **Đường dẫn ảnh**: Nếu sử dụng URL thật, thay đổi `https://via.placeholder.com/...` trong seeder bằng ảnh thật

2. **Storage Link**: Nếu muốn upload ảnh vào storage:
```bash
php artisan storage:link
```

3. **Permission**: Đảm bảo thư mục `public/uploads` có quyền ghi

4. **Testing**: Test các chức năng:
   - Đăng nhập Admin
   - Thêm/sửa/xóa sản phẩm
   - Mua hàng từ frontend
   - Duyệt đơn hàng từ admin

---

## DEMO WORKFLOW (Cho thuyết trình)

1. **Mở trang chủ** → Xem danh sách sản phẩm
2. **Click sản phẩm** → Xem chi tiết
3. **Thêm vào giỏ** → Vào giỏ hàng
4. **Đăng nhập** → Tiến hành thanh toán
5. **Điền thông tin** → Đặt hàng thành công
6. **Logout** → Login Admin
7. **Vào đơn hàng** → Duyệt đơn → Đổi trạng thái
8. **Vào Dashboard** → Xem thống kê thay đổi

---

## TROUBLESHOOTING

**Lỗi Class not found:**
```bash
composer dump-autoload
```

**Lỗi Upload ảnh:**
```bash
chmod -R 775 public/uploads
```

**Lỗi Migration:**
```bash
php artisan migrate:fresh
```

**Cache clear:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

---

## KẾT LUẬN

Dự án đã bao gồm đầy đủ:
- ✅ Database design hoàn chỉnh
- ✅ CRUD đầy đủ cho Admin
- ✅ Giỏ hàng với Session
- ✅ Checkout và quản lý đơn hàng
- ✅ Dashboard với biểu đồ
- ✅ Giao diện responsive (Bootstrap)
- ✅ Authentication (Laravel Breeze)

**Thời gian ước tính**: 2-3 ngày để hoàn thiện và test kỹ!

---

**Chúc bạn làm project thành công! 🎉**
