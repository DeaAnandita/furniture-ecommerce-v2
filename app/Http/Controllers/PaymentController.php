<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }

    /**
     * Halaman payment
     */
    public function index($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('payment.index', compact('order'));
    }

    /**
     * Generate Snap Token
     */
    public function pay($id)
    {
        try {

            $order = Order::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            if ($order->snap_token) {
                return response()->json([
                    'snap_token' => $order->snap_token
                ]);
            }

            $params = [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $order->id,
                    'gross_amount' => (int) $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            $order->update([
                'snap_token' => $snapToken
            ]);

            return response()->json([
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);

        }
    }

    /**
     * Callback / Notification Midtrans
     */
    public function callback(Request $request)
    {
        \Log::info('MIDTRANS CALLBACK', $request->all());

        $serverKey = config('midtrans.serverKey');

        $signature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signature !== $request->signature_key) {

            return response()->json([
                'message' => 'Invalid signature'
            ], 403);

        }

        $orderId = str_replace('ORDER-', '', $request->order_id);

        $order = Order::find($orderId);

        if (!$order) {

            return response()->json([
                'message' => 'Order not found'
            ], 404);

        }

        $transactionStatus = $request->transaction_status;

        // SUCCESS
        if (
            $transactionStatus === 'settlement' ||
            ($transactionStatus === 'capture' && $request->fraud_status === 'accept')
        ) {

            $order->update([
                'payment_status' => 'paid',
                'payment_type' => $request->payment_type,
                'transaction_id' => $request->transaction_id,
            ]);

        }

        // PENDING
        elseif ($transactionStatus === 'pending') {

            $order->update([
                'payment_status' => 'pending',
                'payment_type' => $request->payment_type,
                'transaction_id' => $request->transaction_id,
            ]);

        }

        // FAILED
        elseif (
            $transactionStatus === 'deny' ||
            $transactionStatus === 'expire' ||
            $transactionStatus === 'cancel'
        ) {

            $order->update([
                'payment_status' => 'failed',
                'payment_type' => $request->payment_type,
                'transaction_id' => $request->transaction_id,
            ]);

        }

        return response()->json([
            'message' => 'OK'
        ]);
    }
}