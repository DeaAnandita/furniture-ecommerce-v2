<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Checkout Process
     */
    public function store(Request $request)
    {
        $carts = Cart::with('product')
                    ->where('user_id', auth()->id())
                    ->get();

        if($carts->count() < 1){

            return redirect('/cart')
                ->with('error', 'Cart masih kosong');

        }

        $total = 0;

        foreach($carts as $cart){

            $total += $cart->product->price * $cart->quantity;

        }

        // CREATE ORDER
        $order = Order::create([

            'user_id' => auth()->id(),

            'total_price' => $total,

            'payment_status' => 'pending'

        ]);

        // ORDER ITEMS
        foreach($carts as $cart){

            OrderItem::create([

                'order_id' => $order->id,

                'product_id' => $cart->product_id,

                'quantity' => $cart->quantity,

                'price' => $cart->product->price

            ]);

        }

        // HAPUS CART
        Cart::where('user_id', auth()->id())->delete();

        // REDIRECT KE HALAMAN PAYMENT
        return redirect()->route('payment.index', $order->id);
    }
}