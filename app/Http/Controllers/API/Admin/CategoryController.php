<?php

namespace App\Http\Controllers\API\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return ResponseFormatter::success(CategoryResource::collection(Category::paginate(10)), 'Load Success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $data['slug'] = Str::slug($request->name);
            $data['photo'] = $request->file('photo')->store('assets/category', 'public');

            $category = Category::create($data);

            return ResponseFormatter::success($category, 'Data saved successfully');
        } catch (\Exception $e) {
            return ResponseFormatter::error(null, $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $item = Category::findOrFail($id);

            return ResponseFormatter::success($item, 'Load success');
        } catch (\Exception $e) {
            return ResponseFormatter::error(null, $e->getMessage(), $e->getCode());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            $data['slug'] = Str::slug($request->name);
            $data['photo'] = $request->file('photo')->store('assets/category', 'public');

            $category = Category::findOrFail($id);
            $category->update($data);

            return ResponseFormatter::success($category, 'Load success');
        } catch (\Exception $e) {
            return ResponseFormatter::error(null, $e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $data = Category::findOrFail($id);
            $data->delete();

            return ResponseFormatter::success(null, 'Delete Successful');
        } catch (\Exception $e) {
            return ResponseFormatter::error(null, $e->getMessage(), $e->getCode());
        }
    }
}
