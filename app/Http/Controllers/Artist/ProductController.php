<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Tag;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('artist.product.index')->with([
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('artist.product.create')->with([
            'categories' => $categories,
            'tags' => $tags
        ]);
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
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'featured_img' => 'required|max:300',
        ]);

        $tags = $request->input('tag_id');

        $p = new Product();
        $p->name = $request->input('name');
        $p->description = $request->input('description');
        $p->price = $request->input('price');
        $p->sale_price = $request->input('sale_price');
        $p->featured_img = $request->input('featured_img');

        $p->save();

        foreach ($tags as $t){
            $p->tags()->attach($t);
        }
        $p->categories()->attach($request->input('category_id'));

        return redirect()->route('products.index');
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
        $p = Product::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('artist.product.edit')->with([
            'p' => $p,
            'categories' => $categories,
            'tags' => $tags
        ]);
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
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'featured_img' => 'required|max:300',
        ]);

        $tags = $request->input('tag_id');

        $p = Product::find($id);
        $p->name = $request->input('name');
        $p->description = $request->input('description');
        $p->price = $request->input('price');
        $p->sale_price = $request->input('sale_price');
        $p->featured_img = $request->input('featured_img');

        $p->save();

        $p->tags()->sync($tags);
        $p->categories()->sync($request->input('category_id'));

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Product::find($id);
        $p->delete();

        return redirect()->route('products.index');
    }
}
