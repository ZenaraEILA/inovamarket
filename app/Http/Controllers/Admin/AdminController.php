<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalOrders = Order::count();
        $totalCategories = Category::count();

        $recentOrders = Order::with('user', 'orderItems.product')->latest()->take(5)->get();
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalOrders',
            'totalCategories',
            'recentOrders',
            'monthlyRevenue'
        ));
    }
}
