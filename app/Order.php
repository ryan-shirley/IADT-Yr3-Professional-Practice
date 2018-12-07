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

    // get shipping method for the order
    public function shipping_method()
    {
      return $this->belongsTo('App\ShippingMethod');
    }

    // get the events belongs to the order
    public function events()
    {
      return $this->hasMany('App\Event');
    }

    public function subTotal(){
      $total = 0.0;
      foreach($this->products as $product) {
        $total += $product->price * $product->pivot->quantity;
      }
      return $total;
    }

    public function total(){
      $total = 0.0;
      foreach($this->products as $product) {
        $total += $product->price * $product->pivot->quantity;
      }
      $total += $this->shipping_method->cost;
      return $total;
    }

    public function totalItems(){
        $total = 0;

        foreach($this->products as $product) {
          $total += 1 * $product->pivot->quantity;
        }
        return $total;
    }


}
