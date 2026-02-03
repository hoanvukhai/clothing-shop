# DỰ ÁN WEB BÁN QUẦN ÁO - LARAVEL

## 📋 THÔNG TIN DỰ ÁN

**Tên dự án**: Website kinh doanh thời trang Fashion Shop

**Công nghệ**:
- Backend: PHP Laravel Framework 11
- Database: MySQL
- Frontend: Blade Template + Bootstrap 5
- Authentication: Laravel Breeze

---

## 🎯 MỤC TIÊU DỰ ÁN

Xây dựng website bán quần áo trực tuyến hoàn chỉnh với đầy đủ chức năng:
- Khách hàng có thể xem, tìm kiếm và mua sản phẩm
- Admin có thể quản lý sản phẩm, đơn hàng và theo dõi doanh thu

---

## 🗂️ CẤU TRÚC DATABASE

### 5 Bảng chính:

1. **users** - Người dùng (Khách hàng & Admin)
   - id, name, email, password, role (0=user, 1=admin)

2. **categories** - Danh mục sản phẩm
   - id, name, slug, description

3. **products** - Sản phẩm
   - id, category_id, name, slug, description, price, image, quantity

4. **orders** - Đơn hàng
   - id, user_id, customer_name, customer_phone, customer_address, total_money, status

5. **order_details** - Chi tiết đơn hàng
   - id, order_id, product_id, price, quantity

---

## ✨ CHỨC NĂNG CHI TIẾT

### 👤 FRONTEND (Khách hàng)

✅ **Xem sản phẩm**
- Trang chủ hiển thị danh sách sản phẩm
- Lọc theo danh mục
- Xem chi tiết sản phẩm
- Hiển thị sản phẩm liên quan

✅ **Tìm kiếm**
- Tìm kiếm theo tên sản phẩm
- Hiển thị kết quả phân trang

✅ **Giỏ hàng**
- Thêm sản phẩm vào giỏ
- Cập nhật số lượng
- Xóa sản phẩm
- Tính tổng tiền tự động

✅ **Đặt hàng**
- Điền thông tin giao hàng
- Xác nhận đơn hàng
- Thanh toán COD (Thanh toán khi nhận hàng)
- Xem thông tin đơn hàng sau khi đặt

✅ **Tài khoản**
- Đăng ký tài khoản mới
- Đăng nhập / Đăng xuất
- Quản lý thông tin cá nhân

---

### 🔧 BACKEND (Admin)

✅ **Dashboard**
- Thống kê tổng quan (Tổng đơn hàng, doanh thu, sản phẩm)
- Biểu đồ doanh thu 7 ngày
- Sản phẩm bán chạy
- Đơn hàng mới nhất

✅ **Quản lý Danh mục**
- Xem danh sách
- Thêm danh mục mới
- Sửa danh mục
- Xóa danh mục (nếu không có sản phẩm)

✅ **Quản lý Sản phẩm**
- Xem danh sách sản phẩm
- Thêm sản phẩm (có upload ảnh)
- Sửa thông tin sản phẩm
- Xóa sản phẩm
- Hiển thị/Ẩn sản phẩm

✅ **Quản lý Đơn hàng**
- Xem danh sách đơn hàng
- Lọc theo trạng thái
- Xem chi tiết đơn hàng
- Cập nhật trạng thái (Chờ duyệt → Đang giao → Hoàn thành)
- Xóa đơn hàng đã hủy

---

## 🚀 HƯỚNG DẪN CÀI ĐẶT

Xem chi tiết trong file: **HUONG_DAN_CAI_DAT.md**

### Quick Start:

```bash
# 1. Tạo project
composer create-project laravel/laravel clothing-shop
cd clothing-shop

# 2. Cài đặt Breeze
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build

# 3. Cấu hình .env và tạo database

# 4. Copy các file migration, model, controller, view

# 5. Chạy migration
php artisan migrate:fresh --seed

# 6. Chạy server
php artisan serve
```

---

## 👥 TÀI KHOẢN MẶC ĐỊNH

**Admin:**
- Email: `admin@example.com`
- Password: `admin123`
- Truy cập: http://localhost:8000/admin

**User:**
- Email: `user@example.com`
- Password: `user123`

---

## 📂 CẤU TRÚC THƯ MỤC

```
clothing-shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/            # Admin controllers
│   │   │   ├── HomeController.php
│   │   │   ├── CartController.php
│   │   │   └── CheckoutController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/                   # Eloquent Models
├── database/
│   ├── migrations/               # Database migrations
│   └── seeders/
│       └── DatabaseSeeder.php    # Dữ liệu mẫu
├── resources/
│   └── views/
│       ├── layouts/              # Layout chính
│       ├── admin/                # Views admin
│       └── *.blade.php           # Views frontend
├── routes/
│   └── web.php                   # Định nghĩa routes
└── public/
    └── uploads/
        └── products/             # Thư mục lưu ảnh
```

---

## 🎨 GIAO DIỆN

- **Frontend**: Bootstrap 5 - Responsive, hiện đại
- **Admin**: Dashboard với sidebar - Giao diện chuyên nghiệp
- **Icons**: Font Awesome 6
- **Charts**: Chart.js cho biểu đồ

---

## 📊 DEMO WORKFLOW (Thuyết trình)

1. Mở trang chủ → Xem sản phẩm
2. Thêm sản phẩm vào giỏ hàng
3. Đăng nhập → Thanh toán
4. Đặt hàng thành công
5. Logout → Login Admin
6. Duyệt đơn hàng → Cập nhật trạng thái
7. Xem Dashboard → Thống kê cập nhật

---

## 🔒 BẢO MẬT

- ✅ Authentication với Laravel Breeze
- ✅ Middleware kiểm tra quyền Admin
- ✅ CSRF Protection
- ✅ Password Hashing
- ✅ Validation đầu vào

---

## 📈 TÍNH NĂNG NỔI BẬT

🌟 **Giỏ hàng Session-based**: Không cần login để thêm sản phẩm

🌟 **AJAX Cart Update**: Cập nhật số lượng không reload trang

🌟 **Sản phẩm liên quan**: Hiển thị sản phẩm cùng danh mục

🌟 **Dashboard Analytics**: Biểu đồ doanh thu + Top sản phẩm

🌟 **Upload ảnh**: Xử lý upload và lưu trữ ảnh sản phẩm

🌟 **Responsive Design**: Giao diện tối ưu cho mobile

---

## 📝 TÀI LIỆU THAM KHẢO

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3/)
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)

---

## 🐛 TROUBLESHOOTING

**Lỗi Permission Denied khi upload:**
```bash
chmod -R 775 public/uploads
```

**Lỗi Class not found:**
```bash
composer dump-autoload
```

**Clear cache:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

---

## 📞 HỖ TRỢ

Nếu gặp vấn đề, hãy kiểm tra:
1. PHP version >= 8.1
2. Composer đã cài đặt
3. MySQL đang chạy
4. File .env đã cấu hình đúng
5. Migration đã chạy thành công

---

## ✅ CHECKLIST TRƯỚC KHI NỘP BÀI

- [ ] Database đã tạo và migrate thành công
- [ ] Dữ liệu mẫu đã seed
- [ ] Test đăng nhập Admin
- [ ] Test thêm/sửa/xóa sản phẩm
- [ ] Test mua hàng từ frontend
- [ ] Test cập nhật đơn hàng
- [ ] Kiểm tra responsive trên mobile
- [ ] Screenshot các màn hình quan trọng
- [ ] Chuẩn bị báo cáo + slide thuyết trình

---

**Phiên bản**: 1.0
**Ngày cập nhật**: 2024
**Tác giả**: [Tên của bạn]

---

🎉 **Chúc bạn thành công với dự án!**
