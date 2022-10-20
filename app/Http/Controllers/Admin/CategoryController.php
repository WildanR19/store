<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax())
        {
            $query = Category::query();

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="'. route('categories.edit', $item->id) .'" class="dropdown-item">Edit</a>
                                    <form action="'. route('categories.destroy', $item->id) .'" method="post">
                                    '. csrf_field().''. method_field('delete') .'
                                        <button class="dropdown-item text-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('photo', function ($item) {
                    return $item->photo ? '
                        <img src="'. Storage::url($item->photo) .'" alt="'.$item->name.'" style="max-height: 40px" />' : '';
                })
                ->rawColumns(['photo', 'action'])
                ->make();
        }
        return view('pages.admin.category.index');
    }

    public function create()
    {
        return view('pages.admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/category', 'public');

        Category::create($data);

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = Category::findOrFail($id);

        return view('pages.admin.category.edit', [
            'item' => $item,
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/category', 'public');

        $category = Category::findOrFail($id);
        $category->update($data);

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();

        return redirect()->back();
    }
}
