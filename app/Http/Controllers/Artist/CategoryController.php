<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('artist.category.index')->with([
            'categories' => $categories
        ]);
    }
    public function viewProducts($id)
    {
        $category = Category::find($id);

        // $products = Product::with('categories')->whereHas('categories', function($query) use ($id) {
        //     $query->where('category_id', 'LIKE', "$id");
        // })->get();

        //$products = $category->products;

        // $products = Product::whereHas('tags', function ($query){
        //     $query->where('tag_id', 'like', $id);
        // })->get();

        return view('artist.category.viewProducts')->with([
            //'products' => $products,
            'category' => $category
        ]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artist.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:300',
        ]);

        $c = new Category();
        $c->name = $request->input('name');
        $c->description = $request->input('description');

        $c->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('artist.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:300',
        ]);

        $c = Category::find($id);
        $c->name = $request->input('name');
        $c->description = $request->input('description');

        $c->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c = Category::find($id);
        $c->delete();

        return redirect()->route('categories.index');
    }
}
