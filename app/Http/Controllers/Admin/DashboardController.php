<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // CARD
        $totalProducts = Product::count();

        $totalOrders = Order::count();

        $totalRevenue = Order::where('payment_status', 'paid')
            ->sum('total_price');

        $pendingOrders = Order::where('payment_status', 'pending')
            ->count();

        // RECENT ORDER
        $recentOrders = Order::latest()
            ->take(5)
            ->get();

        // CHART PENJUALAN 7 HARI
        $salesChart = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('payment_status', 'paid')
            ->whereDate('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'recentOrders',
            'salesChart'
        ));
    }
}