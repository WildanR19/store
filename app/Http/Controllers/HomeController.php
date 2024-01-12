<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with('gallery')->take(8)->latest()->get();

        return view('pages.home', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function details($slug)
    {
        $product = Product::with(['gallery', 'user'])->where('slug', $slug)->firstOrFail();

        return view('pages.details', [
            'product' => $product,
        ]);
    }

    public function addToCart($id)
    {
        $data = [
            'product_id' => $id,
            'user_id' => Auth::user()->id,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
