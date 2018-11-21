<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Address;
use App\Product;
use App\ShippingMethod;

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
        $shipping_method = ShippingMethod::all()->first();
        $p1 = Product::where('name', 'Product 1')->first();
        $p2 = Product::where('name', 'Product 2')->first();

        $order = new Order();
        $order->user_id = 3;
        $order->order_date = '2018-11-17';
        $order->fulfillment_date = '2018-11-17';
        $order->payment_status = 1;
        $order->fulfillment_status = 1;
        $order->shipping_address = $shipping->line1;
        $order->billing_address = $billing->line1;
        $order->shipping_method_id = $shipping_method->id;
        $order->save();
        $order->products()->attach($p1);

        $order = new Order();
        $order->user_id = 3;
        $order->order_date = '2018-11-17';
        $order->fulfillment_date = '2018-11-17';
        $order->payment_status = 1;
        $order->fulfillment_status = 1;
        $order->shipping_address = $shipping->line1;
        $order->billing_address = $billing->line1;
        $order->shipping_method_id = $shipping_method->id;
        $order->save();
        $order->products()->attach($p1);
        $order->products()->attach($p2);

        $order = new Order();
        $order->user_id = 3;
        $order->order_date = '2018-11-17';
        $order->fulfillment_date = '2018-11-17';
        $order->payment_status = 1;
        $order->fulfillment_status = 1;
        $order->shipping_address = $shipping->line1;
        $order->billing_address = $billing->line1;
        $order->shipping_method_id = $shipping_method->id;
        $order->save();
        $order->products()->attach($p2);
    }
}
