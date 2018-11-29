<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // get the order of this event
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
