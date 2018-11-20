<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Get the user that owns the adddress.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
