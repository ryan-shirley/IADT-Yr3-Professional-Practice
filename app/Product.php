<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The Categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * The Tags that belong to the product.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
