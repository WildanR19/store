<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with('gallery')->take(8)->latest()->get();

        return ResponseFormatter::success(['category' => CategoryResource::collection($categories), 'products' => ProductResource::collection($products)], 'Load Success');
    }


}
