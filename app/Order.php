<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // get user that owns the order.
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    // get products for the order
    public function products()
    {
      return $this->belongsToMany('App\Product')->withPivot('price', 'quantity')->withTimestamps();
    }

    // get shipping method for this order
    public function shipping_method()
    {
      return $this->belongsTo('App\ShippingMethod');
    }

    public function total(){
      $total = 0.0;
      foreach($this->products as $product) {
        $total += $product->price * $product->pivot->quantity;
      }
      return $total;
    }
}
