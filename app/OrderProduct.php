<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    /**
     * Get the shipment that owns the order product.
     */
    public function shipment()
    {
        return $this->belongsTo('App\Shipment');
    }
}
