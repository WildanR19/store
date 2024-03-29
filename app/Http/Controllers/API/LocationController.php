<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;

class LocationController extends Controller
{
    public function province()
    {
        return Province::all();
    }

    public function regency($province_id)
    {
        return Regency::where('province_id', $province_id)->get();
    }
}
