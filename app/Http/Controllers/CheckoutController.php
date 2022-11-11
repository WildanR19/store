<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // create data transaction
        $code = 'STORE-' . uniqid();
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code,
        ]);

        $carts = Cart::with(['user','product'])
            ->where('user_id', $user->id)
            ->get();

        foreach ($carts as $cart) {
            $trx = 'TRX-'. uniqid();

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product->id,
                'price' => $cart->product->price,
                'resi' => null,
                'shipping_status' => 'PENDING',
                'code' => $trx,
            ]);
        }

        // delete cart
        Cart::where('user_id', $user->id)->delete();

        // midtrans process
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = [
            "transaction_details" => [
                "order_id" => $code,
                "gross_amount" => (int) $request->total_price
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'other_va'
            ],
            'vtweb' => []
        ];


        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function callback()
    {

    }
}
