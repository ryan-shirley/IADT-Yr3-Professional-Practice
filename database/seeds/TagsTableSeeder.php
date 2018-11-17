<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = new Tag();
        $tag->name = 'Colour';
        $tag->description = 'Colour';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Black & White';
        $tag->description = 'Black & White';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Flat';
        $tag->description = 'Flat';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Embossed';
        $tag->description = 'Embossed';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Room';
        $tag->description = 'Room';
        $tag->save();
    }
}
