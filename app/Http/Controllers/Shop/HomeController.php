<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::all()->sortByDesc("id");
        $categories  = Category::all();

        return view('shop.home')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('shop.product.view')->with([
            'product' => $product
        ]);
    }


}
