<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function storeIndex()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard.store.index', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    public function accountIndex()
    {
        $user = Auth::user();

        return view('pages.dashboard.account.index', ['user' => $user]);
    }

    public function update(Request $request)
    {
//        return dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address_one' => 'nullable|string|max:255',
            'address_two' => 'nullable|string|max:255',
            'province_id' => 'nullable|integer|exists:provinces,id',
            'regencies_id' => 'nullable|integer|exists:regencies,id',
            'zip_code' => 'nullable|integer',
            'country' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
        ]);

        Auth::user()->update($validated);

        return redirect()->back();
    }
}
