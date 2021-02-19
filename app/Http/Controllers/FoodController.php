<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    public function index()
    {
        $foods = auth()->user()->foods;

        return response()->json([
            'success' => true,
            'data' => $foods
        ]);
    }

    public function show($id)
    {
        $food = auth()->user()->foods()->find($id);

        if(!$food) {
            return response()->json([
                'success' => false,
                'message' => 'Food not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $food->toArray()
        ], 400);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'            
        ]);
 
        $food = new Food();
        $food->name = $request->name;        
 
        if (auth()->user()->restaurants()->foods()->save($food))
            return response()->json([
                'success' => true,
                'data' => $food->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Food not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $food = auth()->user()->foods()->find($id);
 
        if (!$food) {
            return response()->json([
                'success' => false,
                'message' => 'Food not found'
            ], 400);
        }
 
        $updated = $food->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Food can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $food = auth()->user()->restaurants()->foods()->find($id);
 
        if (!$food) {
            return response()->json([
                'success' => false,
                'message' => 'Food not found'
            ], 400);
        }
 
        if ($food->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Food can not be deleted'
            ], 500);
        }
    }
}
