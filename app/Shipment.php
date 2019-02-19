<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    /**
     * Get the products for the shipment.
     */
    public function products()
    {
        return $this->hasMany('App\OrderProduct', 'order_id', 'order_id');
    }

    /**
     * Get the order that owns the shipment.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
