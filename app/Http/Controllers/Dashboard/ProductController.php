<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['gallery', 'category'])
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('pages.dashboard.product.index', ['products' => $products]);
    }

    public function details($id)
    {
        $product = Product::with(['gallery', 'category'])->findOrFail($id);
        $categories = Category::all();

        return view('pages.dashboard.product.details',
            [
                'product' => $product,
                'categories' => $categories
            ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.dashboard.product.create', ['categories' => $categories]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $gallery = [
            'product_id' => $product->id,
            'photo' => $request->file('thumbnails')->store('assets/product', 'public'),
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard.product');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::findOrFail($id);
        $product->update($data);

        return redirect()->route('dashboard.product');
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->back();
    }

    public function deleteGallery($id)
    {
        $data = ProductGallery::findOrFail($id);
        $data->delete();

        return redirect()->back();
    }
}
