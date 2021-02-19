<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = auth()->user()->restaurants;

        return response()->json([
            'success' => true,
            'data' => $restaurants
        ]);
    }

    public function show($id)
    {
        $restaurant = auth()->user()->restaurants()->find($id);

        if(!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $restaurant->toArray()
        ], 400);

    }
}
