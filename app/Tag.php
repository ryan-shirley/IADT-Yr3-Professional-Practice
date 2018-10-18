<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The products that belong to the tag.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
