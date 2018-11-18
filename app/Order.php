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
      return $this->hasMany('App\Product')->withPivot('quantity')->withTimestamps();
    }

    // public function total(){
    //   $total = 0.0;
    //   foreach($this->products as $product) {
    //     $total += $product->price * $book->pivot->quantity;
    //   }
    //   return $total;
    // }
}
