<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    // Orders belong to the shipping_method
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
