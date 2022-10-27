<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with('gallery')->take(8)->latest()->get();

        return view('pages.home', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function details()
    {
        return view('pages.details');
    }

    public function success()
    {
        return view('pages.success');
    }
}
