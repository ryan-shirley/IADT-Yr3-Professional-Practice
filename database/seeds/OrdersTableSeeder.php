<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Address;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipping = Address::where('shipping', true)->first();
        $billing = Address::where('billing', true)->first();

        $order = new Order();
        $order->user_id = 3;
        $order->order_date = '2018-11-17';
        $order->fulfillment_date = '2018-11-17';
        $order->payment_status = 1;
        $order->fulfillment_status = 1;
        $order->shipping_address = $shipping->line1;
        $order->billing_address = $billing->line1;
        $order->shipping_method_id = 1;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->order_date = '2018-11-17';
        $order->fulfillment_date = '2018-11-17';
        $order->payment_status = 1;
        $order->fulfillment_status = 1;
        $order->shipping_address = $shipping->line1;
        $order->billing_address = $billing->line1;
        $order->shipping_method_id = 1;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->order_date = '2018-11-17';
        $order->fulfillment_date = '2018-11-17';
        $order->payment_status = 1;
        $order->fulfillment_status = 1;
        $order->shipping_address = $shipping->line1;
        $order->billing_address = $billing->line1;
        $order->shipping_method_id = 1;
        $order->save();
    }
}
