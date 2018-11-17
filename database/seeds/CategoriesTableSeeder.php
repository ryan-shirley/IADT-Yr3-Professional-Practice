<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new Category();
        $cat->name = 'Prints';
        $cat->description = 'Print';
        $cat->save();

        $cat = new Category();
        $cat->name = 'Canvas';
        $cat->description = 'Printed on Canvas';
        $cat->save();

        $cat = new Category();
        $cat->name = 'Ditigal';
        $cat->description = 'Digital File';
        $cat->save();

        $cat = new Category();
        $cat->name = 'Wallpaper';
        $cat->description = 'Wallpapers';
        $cat->save();
    }
}
