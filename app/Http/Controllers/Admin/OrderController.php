<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display orders
     */
    public function index(Request $request)
    {
        $query = Order::with('user');

        // FILTER STATUS
        if ($request->status) {

            $query->where('payment_status', $request->status);

        }

        // SEARCH CUSTOMER
        if ($request->search) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%');

            });

        }

        // SORT
        $sort = $request->sort;
        $direction = $request->direction ?? 'asc';

        if ($sort == 'customer') {

            $query->join('users', 'orders.user_id', '=', 'users.id')
                ->orderBy('users.name', $direction)
                ->select('orders.*');

        } elseif ($sort == 'total') {

            $query->orderBy('total_price', $direction);

        } elseif ($sort == 'status') {

            $query->orderBy('payment_status', $direction);

        } elseif ($sort == 'date') {

            $query->orderBy('created_at', $direction);

        } else {

            $query->latest();

        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Detail order
     */
    public function show($id)
    {
        $order = Order::with([
            'user',
            'items.product'
        ])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status payment
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required'
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'payment_status' => $request->payment_status
        ]);

        return back()->with('success', 'Status order berhasil diupdate');
    }
}