<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product.gallery', 'user'])->where('user_id', Auth::user()->id)->get();
        $user = Auth::user();

        return view('pages.cart', [
            'carts' => $carts,
            'user' => $user,
        ]);
    }

    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function success()
    {
        return view('pages.success');
    }
}
