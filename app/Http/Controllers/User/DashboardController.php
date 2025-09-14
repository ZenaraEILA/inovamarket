<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recentOrders = $user->orders()->latest()->take(5)->get();
        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->where('status', 'completed')->sum('total_price');

        return view('user.dashboard', compact('user', 'recentOrders', 'totalOrders', 'totalSpent'));
    }
}
