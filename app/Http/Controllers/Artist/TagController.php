<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Product;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('artist.tag.index')->with([
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artist.tag.create');
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

        $t = new Tag();
        $t->name = $request->input('name');
        $t->description = $request->input('description');

        $t->save();

        return redirect()->route('tags.index');
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
        $tag = Tag::find($id);
        return view('artist.tag.edit', compact('tag'));
    }

    public function viewProducts($id)
    {
        $tag = Tag::find($id);

        $products = Product::with('tags')->whereHas('tags', function($query) use ($id) {
            $query->where('tag_id', 'LIKE', "$id");
        })->get();
        
        // $products = Product::whereHas('tags', function ($query){
        //     $query->where('tag_id', 'like', $id);
        // })->get();

        return view('artist.tag.viewProducts')->with([
            'products' => $products,
            'tag' => $tag
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
        ]);

        $t = Tag::find($id);
        $t->name = $request->input('name');
        $t->description = $request->input('description');

        $t->save();

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $t = Tag::find($id);
        $t->delete();

        return redirect()->route('tags.index');
    }
}
