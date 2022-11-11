<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product.gallery', 'user'])->where('user_id', Auth::user()->id)->get();

        return view('pages.cart', [
            'carts' => $carts
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
