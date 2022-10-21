<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        if (request()->ajax())
        {
            $query = Product::with(['category', 'user']);

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="'. route('product.edit', $item->id) .'" class="dropdown-item">Edit</a>
                                    <form action="'. route('product.destroy', $item->id) .'" method="post">
                                    '. csrf_field().''. method_field('delete') .'
                                        <button class="dropdown-item text-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['photo', 'action'])
                ->make();
        }
        return view('pages.admin.product.index');
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('pages.admin.product.create', [
            'users' => $users,
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        Product::create($data);

        return redirect()->route('product.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $users = User::all();
        $categories = Category::all();

        return view('pages.admin.product.edit', [
            'product' => $product,
            'users' => $users,
            'categories' => $categories
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::findOrFail($id);
        $product->update($data);

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();

        return redirect()->back();
    }
}
