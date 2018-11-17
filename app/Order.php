<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function users()
    {
      return $this->belongsToMany('App\User');
    }

    public function products()
    {
      return $this->belongsToMany()->withPivot('quantity')->withTimestamps();
    }

    public function total(){
      $total = 0.0;
      foreach($this->products as $product) {
        $total += $product->price * $book->pivot->quantity;
      }
      return $total;
    }
}
