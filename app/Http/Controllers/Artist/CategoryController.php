<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:artist');
    }
    /**
     *  Return All Categories
     */
    public function index()
    {
        $categories = Category::all();

        return view('artist.category.index')->with([
            'categories' => $categories
        ]);
    }
    /**
     *  Return 1 Category
     */
    public function viewProducts($id)
    {
        $category = Category::find($id);

        return view('artist.category.viewProducts')->with([
            //'products' => $products,
            'category' => $category
        ]);
    }
    /**
     *  Return a view to create a category
     */
    public function create()
    {
        return view('artist.category.create');
    }

    /**
     *  Stores a data in the DB
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
     *  Not in use, uses viewProducts instead
     */
    public function show($id)
    {
        //
    }

    /**
     *  Returns a view and a category
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('artist.category.edit', compact('category'));
    }

    /**
     *  Updates data values in the DB
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
     *  Deletes a category, also checks if category has products then denied
     */
    public function destroy($id, Request $request)
    {
        $c = Category::find($id);

        if($c->products->count() == 0){
            $c->delete();
            $request->session()->flash('alert-success', $c->name . ' has been deleted');
        }
        else {
            $request->session()->flash('alert-danger', $c->name . ' has products and cannot be deleted');
        }
        return redirect()->route('categories.index');
    }
}
