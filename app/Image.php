<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The products that belong to the image.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('position');
    }

    /**
     * The product that belong to featured image.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
