<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    // GET Method
    public function index() {
        return response()->json([
            'data' => Product::all(),
            'success' => true 
        ], Response::HTTP_OK);
    }

    // POST Method
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $product = Product::create($validated);

        return response()->json([
            'data' => $product,
            'success' => true
        ], Response::HTTP_CREATED);
    }


    // GET Single Product
    public function show(Request $request, Product $product) {
        return response()->json([
            'data' => $product,
            'success' => true
        ], Response::HTTP_OK);
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric'
        ]);

        $product->update($validated);

        return response()->json([
            'data' => $product,
            'success' => true
        ], Response::HTTP_OK);
    }

    public function destroy(Product $product) {

        $product->delete();

        return response()->json([
            'data' => $product,
            'success' => true
        ], Response::HTTP_OK);
    }
}
