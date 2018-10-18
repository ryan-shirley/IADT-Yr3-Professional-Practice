<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('product_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products'); // foreign key
            $table->foreign('tag_id')->references('id')->on('tags'); // foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_tag');
    }
}
