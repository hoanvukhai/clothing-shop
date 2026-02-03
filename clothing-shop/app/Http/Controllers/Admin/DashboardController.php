<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê tổng quan
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_money');
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 0)->count();
        
        // Đơn hàng chờ duyệt
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Doanh thu 7 ngày gần đây
        $revenueChart = Order::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, SUM(total_money) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        // Đơn hàng mới nhất
        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();
        
        // Sản phẩm bán chạy (top 5)
        $topProducts = Product::withCount(['orderDetails as total_sold' => function($query) {
                $query->select(DB::raw('SUM(quantity)'));
            }])
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'totalUsers',
            'pendingOrders',
            'revenueChart',
            'recentOrders',
            'topProducts'
        ));
    }
}