<?php

use Illuminate\Database\Seeder;
use App\Event;
use App\Order;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        
        foreach ($orders as $order) {
            $event = new Event();
            $event->order_id = $order->id;
            $event->name = 'Order created';
            $event->save();
        }

    }
}
