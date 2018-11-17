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
}
