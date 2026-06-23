<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $orders = Order::where('payment_status', 'paid');

        if ($start && $end) {
            $orders->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        $orders = $orders->latest()->get();

        $totalOrders = $orders->count();

        $totalRevenue = $orders->sum('total_price');

        $bestProducts = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('orders.payment_status', 'paid')
            ->select(
                'products.name',
                DB::raw('SUM(order_items.quantity) as sold')
            )
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('sold')
            ->take(5)
            ->get();

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->orderBy('stock')
            ->get();

        return view('admin.reports.index', compact(
            'orders',
            'totalOrders',
            'totalRevenue',
            'bestProducts',
            'lowStockProducts'
        ));
    }

    public function exportPdf(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $orders = Order::where('payment_status', 'paid');

        if ($start && $end) {
            $orders->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        $orders = $orders->latest()->get();

        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total_price');

        $bestProducts = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('orders.payment_status', 'paid')
            ->when($start && $end, function ($q) use ($start, $end) {
                $q->whereBetween('orders.created_at', [
                    $start . ' 00:00:00',
                    $end . ' 23:59:59'
                ]);
            })
            ->select(
                'products.name',
                DB::raw('SUM(order_items.quantity) as sold')
            )
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('sold')
            ->take(5)
            ->get();

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->orderBy('stock')
            ->get();

        $pdf = Pdf::loadView('admin.reports.pdf', compact(
            'orders',
            'totalOrders',
            'totalRevenue',
            'bestProducts',
            'lowStockProducts'
        ));

        return $pdf->download('laporan-penjualan.pdf');
    }
}