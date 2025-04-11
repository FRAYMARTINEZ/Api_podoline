<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CitiesController extends Controller
{
    public function index()
    {
        $city = City::all();
        return response()->json([
            'success' => true,
            'data' => $city
        ]);
    }
}