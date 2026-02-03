<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 1 // Admin
        ]);

        // Tạo User thường
        User::create([
            'name' => 'Khách hàng',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
            'role' => 0 // User
        ]);

        // Tạo Categories
        $categories = [
            ['name' => 'Áo thun', 'slug' => 'ao-thun', 'description' => 'Áo thun nam nữ đẹp, giá rẻ'],
            ['name' => 'Quần jean', 'slug' => 'quan-jean', 'description' => 'Quần jean thời trang'],
            ['name' => 'Áo khoác', 'slug' => 'ao-khoac', 'description' => 'Áo khoác đa dạng mẫu mã'],
            ['name' => 'Váy đầm', 'slug' => 'vay-dam', 'description' => 'Váy đầm nữ sang trọng'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Tạo Products
        $products = [
            // Áo thun
            [
                'category_id' => 1,
                'name' => 'Áo thun nam basic trắng',
                'slug' => 'ao-thun-nam-basic-trang',
                'description' => 'Áo thun nam cổ tròn, chất liệu cotton 100%, thoáng mát',
                'price' => 150000,
                'quantity' => 50,
                'image' => 'https://via.placeholder.com/300x400?text=Ao+Thun+Trang'
            ],
            [
                'category_id' => 1,
                'name' => 'Áo thun nam basic đen',
                'slug' => 'ao-thun-nam-basic-den',
                'description' => 'Áo thun nam cổ tròn màu đen, form rộng thoải mái',
                'price' => 150000,
                'quantity' => 40,
                'image' => 'https://via.placeholder.com/300x400?text=Ao+Thun+Den'
            ],
            [
                'category_id' => 1,
                'name' => 'Áo thun polo nam',
                'slug' => 'ao-thun-polo-nam',
                'description' => 'Áo polo nam lịch sự, phù hợp đi làm',
                'price' => 250000,
                'quantity' => 30,
                'image' => 'https://via.placeholder.com/300x400?text=Ao+Polo'
            ],
            
            // Quần jean
            [
                'category_id' => 2,
                'name' => 'Quần jean nam skinny',
                'slug' => 'quan-jean-nam-skinny',
                'description' => 'Quần jean nam ôm body, co giãn tốt',
                'price' => 350000,
                'quantity' => 25,
                'image' => 'https://via.placeholder.com/300x400?text=Quan+Jean+Skinny'
            ],
            [
                'category_id' => 2,
                'name' => 'Quần jean nam regular fit',
                'slug' => 'quan-jean-nam-regular',
                'description' => 'Quần jean nam form regular, thoải mái',
                'price' => 380000,
                'quantity' => 35,
                'image' => 'https://via.placeholder.com/300x400?text=Quan+Jean+Regular'
            ],
            
            // Áo khoác
            [
                'category_id' => 3,
                'name' => 'Áo khoác hoodie',
                'slug' => 'ao-khoac-hoodie',
                'description' => 'Áo hoodie unisex, chất nỉ dày dặn',
                'price' => 450000,
                'quantity' => 20,
                'image' => 'https://via.placeholder.com/300x400?text=Hoodie'
            ],
            [
                'category_id' => 3,
                'name' => 'Áo khoác bomber',
                'slug' => 'ao-khoac-bomber',
                'description' => 'Áo bomber jacket phong cách thể thao',
                'price' => 550000,
                'quantity' => 15,
                'image' => 'https://via.placeholder.com/300x400?text=Bomber'
            ],
            
            // Váy đầm
            [
                'category_id' => 4,
                'name' => 'Váy maxi hoa',
                'slug' => 'vay-maxi-hoa',
                'description' => 'Váy maxi họa tiết hoa nhẹ nhàng',
                'price' => 400000,
                'quantity' => 18,
                'image' => 'https://via.placeholder.com/300x400?text=Vay+Maxi'
            ],
            [
                'category_id' => 4,
                'name' => 'Đầm công sở',
                'slug' => 'dam-cong-so',
                'description' => 'Đầm công sở thanh lịch, dáng suông',
                'price' => 500000,
                'quantity' => 12,
                'image' => 'https://via.placeholder.com/300x400?text=Dam+Cong+So'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}