<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductGalleryRequest;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductGalleryController extends Controller
{
    public function index()
    {
        if (request()->ajax())
        {
            $query = ProductGallery::with(['product']);

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <form action="'. route('product-gallery.destroy', $item->id) .'" method="post">
                                    '. csrf_field().''. method_field('delete') .'
                                        <button class="dropdown-item text-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('photo', function ($item) {
                    return $item->photo ? '<img src="'. Storage::url($item->photo) .'" alt="'.$item->name.'" style="max-height: 80px" />' : '';
                })
                ->rawColumns(['photo', 'action'])
                ->make();
        }
        return view('pages.admin.productGallery.index');
    }

    public function create()
    {
        $products = Product::all();

        return view('pages.admin.productGallery.create', [
            'products' => $products,
        ]);
    }

    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('product-gallery.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
       //
    }

    public function update(ProductGalleryRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $data = ProductGallery::findOrFail($id);
        $data->delete();

        return redirect()->back();
    }
}
