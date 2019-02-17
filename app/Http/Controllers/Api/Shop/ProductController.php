<?php

namespace App\Http\Controllers\Api\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{

    /**
     * Return All Products
     */
    public function index(Request $request)
    {
        $products = Product::with('image')->get();

        return response()->json($products, 200);
    }

    /**
     * Returns 1 Product
     */
    public function find($id)
    {
        $product = Product::with('image')->get()->find($id);

        return response()->json($product, 200);
    }
}
