<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Tag;
use App\Category;
use App\Image;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = Tag::where('name', 'Colour')->first();
        $cat = Category::where('name', 'Prints')->first();
        $img = Image::all()->first();

        $product = new Product();
        $product->name = 'Product 1';
        $product->description = 'This is some info about the product';
        $product->price = 79.00;
        $product->featured_img = $img->id;
        $product->stock = 10;
        $product->save();
        $product->tags()->attach($tag);
        $product->categories()->attach($cat);

        $tag = Tag::where('name', 'Colour')->first();
        $cat = Category::where('name', 'Prints')->first();

        $product = new Product();
        $product->name = 'Product 2';
        $product->description = 'This is some info about the product';
        $product->price = 102.00;
        $product->featured_img = $img->id;
        $product->stock = 10;
        $product->save();
        $product->tags()->attach($tag);
        $product->categories()->attach($cat);

        $tag = Tag::where('name', 'Flat')->first();
        $cat = Category::where('name', 'Canvas')->first();

        $product = new Product();
        $product->name = 'Product 3';
        $product->description = 'This is some info about the product';
        $product->price = 102.00;
        $product->featured_img = $img->id;
        $product->stock = 10;
        $product->save();
        $product->tags()->attach($tag);
        $product->categories()->attach($cat);

        $tag = Tag::where('name', 'Flat')->first();
        $cat = Category::where('name', 'Canvas')->first();

        $product = new Product();
        $product->name = 'Product 4';
        $product->description = 'This is some info about the product';
        $product->price = 45.00;
        $product->featured_img = $img->id;
        $product->stock = 10;
        $product->save();
        $product->tags()->attach($tag);
        $product->categories()->attach($cat);
    }
}
