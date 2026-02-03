<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/danh-muc/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/san-pham/{slug}', [HomeController::class, 'product'])->name('product');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');

// Cart Routes
Route::middleware('auth')->prefix('gio-hang')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/them/{id}', [CartController::class, 'add'])->name('add');
    Route::post('/cap-nhat/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/xoa/{id}', [CartController::class, 'remove'])->name('remove');
    Route::get('/xoa-tat-ca', [CartController::class, 'clear'])->name('clear');
});

// Checkout Routes
Route::middleware('auth')->prefix('thanh-toan')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
    Route::get('/thanh-cong/{orderId}', [CheckoutController::class, 'success'])->name('success');
});

// Order History Routes
Route::middleware('auth')->prefix('don-hang')->name('orders.')->group(function () {
    Route::get('/', [OrderHistoryController::class, 'index'])->name('index');
    Route::get('/{order}', [OrderHistoryController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Categories
    Route::resource('categories', AdminCategoryController::class);
    
    // Products
    Route::resource('products', AdminProductController::class);
    
    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Users
    Route::resource('users', AdminUserController::class);
});