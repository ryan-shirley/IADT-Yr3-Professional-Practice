<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{

    public function index($id)
    {
        $category  = Category::findOrFail($id);
        $categories  = Category::all();

        return view('shop.category.all')->with([
            'category' => $category,
            'categories' => $categories
        ]);
    }
}
