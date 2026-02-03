# CHECKLIST HOÀN THÀNH DỰ ÁN WEB BÁN QUẦN ÁO

## 📋 PHASE 1: SETUP & CƠ SỞ DỮ LIỆU (Ngày 1 - Buổi sáng)

### Khởi tạo dự án
- [ ] Tạo project Laravel mới
- [ ] Cài đặt Laravel Breeze
- [ ] Cấu hình file .env
- [ ] Tạo database trong MySQL
- [ ] Test kết nối database thành công

### Database Design
- [ ] Tạo migration cho bảng `categories`
- [ ] Tạo migration cho bảng `products`
- [ ] Tạo migration cho bảng `orders`
- [ ] Tạo migration cho bảng `order_details`
- [ ] Tạo migration thêm cột `role` vào bảng `users`
- [ ] Chạy migration thành công (`php artisan migrate`)

### Models & Relationships
- [ ] Tạo Model `Category` với relationships
- [ ] Tạo Model `Product` với relationships
- [ ] Tạo Model `Order` với relationships
- [ ] Tạo Model `OrderDetail` với relationships
- [ ] Cập nhật Model `User` thêm role và relationships
- [ ] Test relationships bằng `php artisan tinker`

---

## 🔧 PHASE 2: MIDDLEWARE & SEEDER (Ngày 1 - Buổi chiều)

### Middleware
- [ ] Tạo `AdminMiddleware`
- [ ] Đăng ký middleware trong `bootstrap/app.php`
- [ ] Test middleware hoạt động

### Seeder
- [ ] Tạo `DatabaseSeeder` với dữ liệu mẫu
- [ ] Thêm ít nhất 4 categories
- [ ] Thêm ít nhất 9 products
- [ ] Tạo 1 admin user (admin@example.com)
- [ ] Tạo 1 user thường (user@example.com)
- [ ] Chạy seed: `php artisan migrate:fresh --seed`
- [ ] Kiểm tra dữ liệu trong database

### Tạo thư mục uploads
- [ ] Tạo `public/uploads/products`
- [ ] Set permission 775: `chmod -R 775 public/uploads`

---

## 🎨 PHASE 3: ADMIN PANEL (Ngày 1 tối & Ngày 2 sáng)

### Admin Controllers
- [ ] Tạo `Admin/DashboardController`
- [ ] Tạo `Admin/CategoryController` (Resource)
- [ ] Tạo `Admin/ProductController` (Resource)
- [ ] Tạo `Admin/OrderController`

### Admin Routes
- [ ] Setup routes trong `routes/web.php`
- [ ] Test tất cả routes admin với `php artisan route:list`

### Admin Views - Layout
- [ ] Tạo `layouts/admin.blade.php`
- [ ] Sidebar với menu navigation
- [ ] Top bar với user info
- [ ] Alert messages display

### Admin Views - Dashboard
- [ ] Tạo `admin/dashboard.blade.php`
- [ ] 4 thẻ thống kê (Đơn hàng, Doanh thu, Sản phẩm, Đơn chờ)
- [ ] Biểu đồ doanh thu 7 ngày (Chart.js)
- [ ] Danh sách sản phẩm bán chạy
- [ ] Bảng đơn hàng mới nhất

### Admin Views - Categories
- [ ] Tạo `admin/categories/index.blade.php` (Danh sách)
- [ ] Tạo `admin/categories/create.blade.php` (Thêm mới)
- [ ] Tạo `admin/categories/edit.blade.php` (Chỉnh sửa)
- [ ] Test CRUD categories hoàn chỉnh

### Admin Views - Products
- [ ] Tạo `admin/products/index.blade.php` (Danh sách)
- [ ] Tạo `admin/products/create.blade.php` (Thêm + Upload ảnh)
- [ ] Tạo `admin/products/edit.blade.php` (Sửa + Thay ảnh)
- [ ] Preview ảnh khi upload
- [ ] Test CRUD products với upload ảnh

### Admin Views - Orders
- [ ] Tạo `admin/orders/index.blade.php` (Danh sách)
- [ ] Tạo `admin/orders/show.blade.php` (Chi tiết)
- [ ] Dropdown cập nhật trạng thái
- [ ] Filter theo trạng thái
- [ ] Test cập nhật trạng thái đơn hàng

---

## 🛍️ PHASE 4: FRONTEND (Ngày 2 chiều & tối)

### Frontend Controllers
- [ ] Tạo `HomeController`
- [ ] Tạo `CartController` 
- [ ] Tạo `CheckoutController`

### Frontend Routes
- [ ] Setup routes frontend
- [ ] Test routes với `php artisan route:list`

### Frontend Layout
- [ ] Tạo `layouts/app.blade.php`
- [ ] Navbar với logo, search, cart icon, user menu
- [ ] Footer
- [ ] Alert messages

### Frontend Views - Trang chủ & Sản phẩm
- [ ] Tạo `home.blade.php` (Danh sách sản phẩm)
- [ ] Tạo `category.blade.php` (Lọc theo danh mục)
- [ ] Tạo `product.blade.php` (Chi tiết sản phẩm)
- [ ] Tạo `search.blade.php` (Kết quả tìm kiếm)
- [ ] Hiển thị sản phẩm liên quan
- [ ] Pagination

### Frontend Views - Giỏ hàng
- [ ] Tạo `cart.blade.php`
- [ ] Hiển thị danh sách sản phẩm trong giỏ
- [ ] Cập nhật số lượng (AJAX)
- [ ] Xóa sản phẩm
- [ ] Tính tổng tiền tự động
- [ ] Button "Tiếp tục mua sắm"
- [ ] Button "Thanh toán"

### Frontend Views - Checkout
- [ ] Tạo `checkout.blade.php`
- [ ] Form thông tin giao hàng
- [ ] Validation form
- [ ] Tạo `checkout-success.blade.php`
- [ ] Hiển thị thông tin đơn hàng vừa đặt

---

## 🧪 PHASE 5: TESTING & BUG FIX (Ngày 3 sáng)

### Test Frontend
- [ ] Mở trang chủ, xem sản phẩm hiển thị đúng
- [ ] Click vào danh mục, filter hoạt động
- [ ] Xem chi tiết sản phẩm
- [ ] Tìm kiếm sản phẩm
- [ ] Thêm sản phẩm vào giỏ hàng
- [ ] Cập nhật số lượng trong giỏ
- [ ] Xóa sản phẩm khỏi giỏ
- [ ] Đăng nhập/Đăng ký
- [ ] Checkout và đặt hàng
- [ ] Kiểm tra trang "Đặt hàng thành công"

### Test Admin
- [ ] Đăng nhập admin
- [ ] Kiểm tra Dashboard hiển thị đúng
- [ ] Thêm danh mục mới
- [ ] Sửa danh mục
- [ ] Xóa danh mục (test cả trường hợp có sản phẩm)
- [ ] Thêm sản phẩm + Upload ảnh
- [ ] Sửa sản phẩm + Thay ảnh
- [ ] Xóa sản phẩm
- [ ] Xem danh sách đơn hàng
- [ ] Xem chi tiết đơn hàng
- [ ] Cập nhật trạng thái đơn: Pending → Processing → Completed
- [ ] Kiểm tra biểu đồ Dashboard cập nhật sau khi đổi trạng thái

### Test Responsive
- [ ] Test trên mobile (375px)
- [ ] Test trên tablet (768px)
- [ ] Test trên desktop (1920px)

### Bug Fix
- [ ] Fix tất cả bugs phát hiện được
- [ ] Kiểm tra validation messages
- [ ] Kiểm tra error handling
- [ ] Test edge cases (giỏ hàng trống, sản phẩm hết hàng, etc.)

---

## 📸 PHASE 6: SCREENSHOT & DOCUMENTATION (Ngày 3 chiều)

### Screenshots cho Báo cáo
- [ ] Trang chủ
- [ ] Chi tiết sản phẩm
- [ ] Giỏ hàng
- [ ] Checkout
- [ ] Đặt hàng thành công
- [ ] Admin Dashboard
- [ ] Admin Quản lý sản phẩm
- [ ] Admin Thêm sản phẩm (có upload ảnh)
- [ ] Admin Quản lý đơn hàng
- [ ] Biểu đồ Dashboard

### Database Screenshots
- [ ] Sơ đồ ERD (vẽ trên draw.io hoặc dbdiagram.io)
- [ ] Screenshot các bảng trong MySQL
- [ ] Screenshot relationships

### Code Screenshots (Phần nổi bật)
- [ ] Screenshot CartController (Session handling)
- [ ] Screenshot ProductController (Upload image)
- [ ] Screenshot AdminMiddleware
- [ ] Screenshot Model relationships

---

## 📝 PHASE 7: BÁO CÁO (Ngày 3 tối - Nếu làm báo cáo)

### Cấu trúc Báo cáo
- [ ] **Chương 1: Mở đầu**
  - Lý do chọn đề tài
  - Mục tiêu dự án
  - Phạm vi thực hiện

- [ ] **Chương 2: Cơ sở lý thuyết**
  - Giới thiệu Laravel (MVC, Eloquent ORM)
  - Giới thiệu MySQL
  - Công nghệ sử dụng (Bootstrap, Chart.js)

- [ ] **Chương 3: Phân tích & Thiết kế**
  - Sơ đồ Use Case
  - Sơ đồ ERD (Database design)
  - Mô tả các chức năng

- [ ] **Chương 4: Cài đặt & Thử nghiệm**
  - Screenshots giao diện
  - Đoạn code tiêu biểu
  - Kết quả testing

- [ ] **Kết luận**
  - Kết quả đạt được
  - Hạn chế
  - Hướng phát triển

---

## 🎤 PHASE 8: SLIDE THUYẾT TRÌNH (Ngày 3 tối - Nếu có thuyết trình)

### Nội dung Slide
- [ ] **Slide 1**: Trang bìa (Tên đề tài, Thành viên)
- [ ] **Slide 2**: Mục tiêu & Bài toán
- [ ] **Slide 3**: Công nghệ sử dụng
- [ ] **Slide 4**: Kiến trúc hệ thống (ERD)
- [ ] **Slide 5**: Chức năng chính
- [ ] **Slide 6-10**: Screenshots giao diện
- [ ] **Slide 11**: Demo trực tiếp (hoặc video)
- [ ] **Slide 12**: Kết luận & Q&A

### Chuẩn bị Demo
- [ ] Script demo rõ ràng (xem DEMO WORKFLOW trong README)
- [ ] Test demo ít nhất 3 lần
- [ ] Backup database (export SQL)
- [ ] Chuẩn bị câu trả lời cho câu hỏi thường gặp

---

## ✅ FINAL CHECKLIST TRƯỚC KHI NỘP

### Code Quality
- [ ] Code đã format đẹp
- [ ] Comments đầy đủ cho các hàm quan trọng
- [ ] Không có code thừa, commented code
- [ ] Variable names có nghĩa

### Files cần có
- [ ] README.md
- [ ] HUONG_DAN_CAI_DAT.md
- [ ] .env.example (copy từ .env nhưng bỏ password)
- [ ] Database SQL export (backup)

### Testing lần cuối
- [ ] Test toàn bộ flow: Xem → Mua → Đặt hàng → Admin duyệt
- [ ] Test với data mới (không phải data seed)
- [ ] Test trên trình duyệt khác (Chrome, Firefox)
- [ ] Test logout/login nhiều lần

### Documentation
- [ ] README viết rõ ràng
- [ ] Hướng dẫn cài đặt chi tiết
- [ ] Screenshots đầy đủ
- [ ] Báo cáo hoàn thiện (nếu có)
- [ ] Slide thuyết trình đẹp (nếu có)

---

## 🎯 ƯU TIÊN KHI THIẾU THỜI GIAN

Nếu chỉ còn 1-2 ngày, tập trung vào:

### Must Have (Bắt buộc):
1. ✅ Database + Migration + Seed
2. ✅ Admin CRUD sản phẩm (có upload ảnh)
3. ✅ Frontend xem sản phẩm + Giỏ hàng
4. ✅ Checkout cơ bản
5. ✅ Admin xem đơn hàng

### Should Have (Nên có):
6. ⭐ Dashboard với thống kê
7. ⭐ Cập nhật trạng thái đơn hàng
8. ⭐ Tìm kiếm sản phẩm

### Nice to Have (Bonus điểm):
9. 🌟 Biểu đồ doanh thu
10. 🌟 Sản phẩm liên quan
11. 🌟 AJAX cart update

---

## 📊 PROGRESS TRACKING

**Tổng số task**: ~150 tasks

- [ ] Phase 1: Setup (10 tasks)
- [ ] Phase 2: Middleware & Seeder (15 tasks)
- [ ] Phase 3: Admin (50 tasks)
- [ ] Phase 4: Frontend (40 tasks)
- [ ] Phase 5: Testing (25 tasks)
- [ ] Phase 6: Screenshots (10 tasks)
- [ ] Phase 7: Báo cáo (Optional)
- [ ] Phase 8: Slide (Optional)

**Tiến độ hiện tại**: _____% hoàn thành

---

## 🔔 NHẮC NHỞ QUAN TRỌNG

⚠️ **Commit code thường xuyên** (nếu dùng Git)
⚠️ **Backup database mỗi ngày**
⚠️ **Test sau mỗi feature hoàn thành**
⚠️ **Đừng để tất cả đến phút chót**
⚠️ **Hỏi thầy/cô khi bí, đừng ngại!**

---

**Chúc bạn hoàn thành xuất sắc dự án! 💪🎉**
