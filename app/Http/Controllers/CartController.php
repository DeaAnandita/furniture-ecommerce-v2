<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Cart page
     */
    public function index()
    {
        $carts = Cart::with('product.category')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('carts'));
    }

    /**
     * Add to cart
     */
    public function add(Request $request)
    {
        $productId = $request->product_id;

        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $productId)
                    ->first();

        if($cart){

            $cart->quantity += 1;
            $cart->save();

        } else {

            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        // total quantity semua cart
        $cartCount = Cart::where('user_id', auth()->id())
                        ->sum('quantity');

        return response()->json([
            'success' => true,
            'cart_count' => $cartCount
        ]);
    }

    /**
     * Plus quantity
     */
    public function plus($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->quantity += 1;
        $cart->save();

        return back();
    }

    /**
     * Minus quantity
     */
    public function minus($id)
    {
        $cart = Cart::findOrFail($id);

        if ($cart->quantity > 1) {

            $cart->quantity -= 1;
            $cart->save();

        } else {

            $cart->delete();
        }

        return back();
    }
}