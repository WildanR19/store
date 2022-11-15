<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function storeIndex() {
        $user = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard.store.index', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function accountIndex() {
        $user = Auth::user();

        return view('pages.dashboard.account.index', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        Auth::user()->update($data);
        return redirect()->back();
    }
}
