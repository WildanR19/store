<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('gallery')->paginate(32);

        return view('pages.category', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function detail($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with('gallery')->where('category_id', $category->id)->paginate(32);

        return view('pages.category', [
            'ctg' => $category,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
