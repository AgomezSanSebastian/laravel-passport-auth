<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::All();

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'street' => 'required'
        ]);
 
        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->street = $request->street;
 
        if (auth()->user()->restaurants()->save($restaurant))
            return response()->json([
                'success' => true,
                'data' => $restaurant->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Restaurant not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $restaurant = auth()->user()->restaurants()->find($id);
 
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant not found'
            ], 400);
        }
 
        $updated = $post->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Restaurant can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $restaurant = auth()->user()->restaurants()->find($id);
 
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant not found'
            ], 400);
        }
 
        if ($restaurant->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant can not be deleted'
            ], 500);
        }
    }
}
