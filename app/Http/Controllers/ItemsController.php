<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemsController extends Controller
{
    public function index() {
        return response()->json([
            'data' => Item::all(),
            'success' => true
        ], Response::HTTP_OK);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $item = Item::create($validated);

        return response()->json([
            'data' => $item,
            'success' => true 
        ], Response::HTTP_CREATED);
    }

    public function show(Item $item) {
        return response()->json([
            'success' => true,
            'data' => $item
        ], Response::HTTP_OK);
    }

    public function update(Request $request, Item $item){
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string'
        ]);

        $item->update($validated);

        return response()->json([
            'success' => true,
            'data' => $item
        ], Response::HTTP_OK);
    }

    public function destroy(Item $item) {
        $item->delete();

        return response()->json([
            'success' => true,
            'data' => $item
        ], Response::HTTP_OK) ;
    }
}
