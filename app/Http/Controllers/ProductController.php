<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'product' => new ProductResource($product),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        $validated = $request->validated();

        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => new ProductResource($product),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
