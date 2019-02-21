<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Tag;
use App\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function __construct()
   {
       $this->middleware('auth');
       $this->middleware('role:artist');
   }

    public function index()
    {
        $products = Product::all()->sortByDesc("id");

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
            'name' => 'required|string',
            'description' => 'required|max:500',
            'category_id' => 'required|exists:categories,id',
            'tag_id' => 'required|exists:tags,id',
            'price' => 'required|numeric',
            // 'sale_price' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'featured_img' => 'required|file|image'
        ]);

        $featured_img = $request->file('featured_img');
        $extension = $featured_img->getClientOriginalExtension();
        $filename = date('Y-m-d-His') . '_' . $request->input('name') . '.' . $extension;
        $path = $featured_img->storeAs('product_images', $filename, 'public');

        $image = new Image();
        $image->title = $request->input('name');
        $image->url = $path;
        $image->save();

        $p = new Product();
        $p->name = $request->input('name');
        $p->description = $request->input('description');
        $p->price = $request->input('price');
        $p->stock = $request->input('stock');
        $p->featured_img = $image->id;

        // if($request->input('sale_price')) {
        //     $p->sale_price = $request->input('sale_price');
        // }

        $p->save();

        $tags = $request->input('tag_id');
        foreach ($tags as $t){
            $p->tags()->attach($t);
        }

        $p->categories()->attach($request->input('category_id'));

        $request->session()->flash('alert-success', $p->name . ' was created successfully');
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
        $product = Product::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('artist.product.show')->with([
          'product' => $product,
          'categories' => $categories,
          'tags' => $tags
        ]);
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
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|max:500',
            'category_id' => 'required|exists:categories,id',
            'tag_id' => 'required|exists:tags,id',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            // 'sale_price' => 'nullable|numeric',
            'featured_img' => 'nullable|file|image'
        ]);

        $p = Product::find($id);

        if($request->input('featured_img') != NULL) {
            $featured_img = $request->file('featured_img');
            $extension = $featured_img->getClientOriginalExtension();
            $filename = date('Y-m-d-His') . '_' . $request->input('name') . '.' . $extension;
            $path = $featured_img->storeAs('product_images', $filename, 'public');

            $image = new Image();
            $image->title = $request->input('name');
            $image->url = $path;
            $image->save();

            $p->featured_img = $image->id;
        }

        $p->name = $request->input('name');
        $p->description = $request->input('description');
        $p->price = $request->input('price');
        $p->stock = $request->input('stock');

        // if($request->input('sale_price')) {
        //     $p->sale_price = $request->input('sale_price');
        // }

        $p->save();

        $category = $request->input('category_id');
        $tags = $request->input('tag_id');

        $p->tags()->sync($tags);
        $p->categories()->sync($category);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $p = Product::findOrFail($id);
        $image = Image::findOrFail($p->featured_img);

        if($p->tags->count()==0){
            $p->delete();
            //if ($image->product->count() == 0) {
            Storage::disk('public')->delete($image->url);
            $image->delete();
            //}
        }
        else {
            $request->session()->flash('alert-danger', $p->name . ' is in some orders and cannot be deleted');
        }

        return redirect()->route('products.index');
    }
}
