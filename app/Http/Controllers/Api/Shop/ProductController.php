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
        $products = Product::all();
        $products->load('image');

        return $products;
    }

    /**
     * Returns 1 Product
     */
    public function find($id)
    {
        $product = Product::find($id);
        $product->load('image');

        return response()->json($product, 200);
    }
}
