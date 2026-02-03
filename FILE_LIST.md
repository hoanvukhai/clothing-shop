# DANH SÁCH TẤT CẢ CÁC FILE ĐÃ TẠO

## 📂 CẤU TRÚC THƯ MỤC LARAVEL

Dưới đây là tất cả các file bạn cần copy vào dự án Laravel:

---

## 1️⃣ MIGRATIONS (database/migrations/)

Đặt tên file theo format: `YYYY_MM_DD_HHMMSS_tên_migration.php`

```
database/migrations/
├── 2024_01_01_000001_create_categories_table.php
├── 2024_01_01_000002_create_products_table.php
├── 2024_01_01_000003_create_orders_table.php
├── 2024_01_01_000004_create_order_details_table.php
└── 2024_01_01_000005_add_role_to_users_table.php
```

**Files:**
- `create_categories_table.php`
- `create_products_table.php`
- `create_orders_table.php`
- `create_order_details_table.php`
- `add_role_to_users_table.php`

---

## 2️⃣ MODELS (app/Models/)

```
app/Models/
├── Category.php
├── Product.php
├── Order.php
├── OrderDetail.php
└── User.php (thay thế file có sẵn)
```

**Files:**
- `Category.php`
- `Product.php`
- `Order.php`
- `OrderDetail.php`
- `User.php`

---

## 3️⃣ MIDDLEWARE (app/Http/Middleware/)

```
app/Http/Middleware/
└── AdminMiddleware.php
```

**Files:**
- `AdminMiddleware.php`

⚠️ **Lưu ý**: Phải đăng ký middleware trong `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})
```

---

## 4️⃣ CONTROLLERS

### 4.1 Admin Controllers (app/Http/Controllers/Admin/)

```
app/Http/Controllers/Admin/
├── DashboardController.php
├── CategoryController.php
├── ProductController.php
└── OrderController.php
```

**Files:**
- `DashboardController.php`
- `CategoryController.php`
- `ProductController.php`
- `OrderController.php`

### 4.2 Frontend Controllers (app/Http/Controllers/)

```
app/Http/Controllers/
├── HomeController.php
├── CartController.php
└── CheckoutController.php
```

**Files:**
- `HomeController.php`
- `CartController.php`
- `CheckoutController.php`

---

## 5️⃣ ROUTES (routes/)

```
routes/
└── web.php (thay thế file có sẵn)
```

**Files:**
- `web.php`

---

## 6️⃣ VIEWS

### 6.1 Layouts (resources/views/layouts/)

```
resources/views/layouts/
├── app.blade.php      (Frontend layout)
└── admin.blade.php    (Admin layout)
```

**Files:**
- `layout.blade.php` → đổi tên thành `app.blade.php`
- `admin-layout.blade.php` → đổi tên thành `admin.blade.php`

### 6.2 Frontend Views (resources/views/)

```
resources/views/
├── home.blade.php
├── category.blade.php
├── product.blade.php
├── search.blade.php
├── cart.blade.php
├── checkout.blade.php
└── checkout-success.blade.php
```

**Files:**
- `home.blade.php`
- `product.blade.php`
- `cart.blade.php`
- `checkout.blade.php`
- `checkout-success.blade.php`

⚠️ **Lưu ý**: Còn thiếu 2 file:
- `category.blade.php` (tương tự home.blade.php)
- `search.blade.php` (tương tự home.blade.php)

### 6.3 Admin Views

```
resources/views/admin/
├── dashboard.blade.php
├── categories/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── products/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── orders/
    ├── index.blade.php
    └── show.blade.php
```

**Files đã có:**
- `admin-dashboard.blade.php` → `admin/dashboard.blade.php`
- `admin-products-index.blade.php` → `admin/products/index.blade.php`
- `admin-products-create.blade.php` → `admin/products/create.blade.php`

**Files còn thiếu** (tôi sẽ tạo ngay):
- `admin/products/edit.blade.php`
- `admin/categories/index.blade.php`
- `admin/categories/create.blade.php`
- `admin/categories/edit.blade.php`
- `admin/orders/index.blade.php`
- `admin/orders/show.blade.php`

---

## 7️⃣ SEEDERS (database/seeders/)

```
database/seeders/
└── DatabaseSeeder.php (thay thế file có sẵn)
```

**Files:**
- `DatabaseSeeder.php`

---

## 8️⃣ PUBLIC FOLDER

```
public/
└── uploads/
    └── products/    (tạo thư mục rỗng)
```

**Lệnh tạo:**
```bash
mkdir -p public/uploads/products
chmod -R 775 public/uploads
```

---

## 9️⃣ DOCUMENTATION FILES (Đặt ở root project)

```
clothing-shop/
├── README.md
├── HUONG_DAN_CAI_DAT.md
└── CHECKLIST.md
```

**Files:**
- `README.md`
- `HUONG_DAN_CAI_DAT.md`
- `CHECKLIST.md`

---

## 🎯 THỨ TỰ THỰC HIỆN

1. **Tạo project Laravel mới**
2. **Copy MIGRATIONS** → Chạy `php artisan migrate`
3. **Copy MODELS**
4. **Copy MIDDLEWARE** → Đăng ký trong bootstrap/app.php
5. **Copy CONTROLLERS**
6. **Copy ROUTES**
7. **Copy SEEDER** → Chạy `php artisan db:seed`
8. **Copy VIEWS** (cả layouts và pages)
9. **Tạo thư mục uploads**
10. **Test ứng dụng**

---

## ✅ CHECKLIST FILES

### ✅ Đã có đầy đủ:
- [x] 5 Migrations
- [x] 5 Models
- [x] 1 Middleware
- [x] 7 Controllers
- [x] 1 Routes file
- [x] 1 Seeder
- [x] 2 Layouts
- [x] 5 Frontend views
- [x] 3 Admin views
- [x] 3 Documentation files

### ⚠️ Cần tạo thêm:
- [ ] 2 Frontend views (category, search)
- [ ] 8 Admin views (categories CRUD, products edit, orders)

---

## 📝 LƯU Ý

1. **Đổi tên file blade đúng format**:
   - `layout.blade.php` → `app.blade.php`
   - `admin-layout.blade.php` → `admin.blade.php`
   - `admin-dashboard.blade.php` → `dashboard.blade.php`

2. **Tạo đúng cấu trúc thư mục**:
   - `Admin/` cho admin controllers
   - `admin/` cho admin views
   - `layouts/` cho layouts

3. **Timestamp migrations**: Đặt theo thứ tự từ cũ đến mới

4. **Bootstrap/app.php**: Đừng quên đăng ký AdminMiddleware

---

Tôi sẽ tiếp tục tạo các file view còn thiếu!
