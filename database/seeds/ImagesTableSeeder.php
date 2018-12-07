<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $img = new Image();
        $img->url = 'product_images/placeholder.jpg';
        $img->title = 'Placeholder';
        $img->save();
    }
}
