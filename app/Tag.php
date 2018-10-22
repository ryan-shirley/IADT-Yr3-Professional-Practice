<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The Products that belong to the tag.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
