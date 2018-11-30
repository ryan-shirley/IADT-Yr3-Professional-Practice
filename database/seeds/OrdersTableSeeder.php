<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Address;
use App\Product;
use App\ShippingMethod;
Use App\Event;

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
        // $p1 = Product::where('name', 'Product 1')->first();
        // $p2 = Product::where('name', 'Product 2')->first();
        $products  = Product::all();

        for($i = 0; $i < 3; $i++) {
            $order = new Order();
            $order->user_id = 3;
            $order->order_date = date("Y-m-d");
            $order->shipping_address = $shipping->line1;
            $order->billing_address = $billing->line1;
            $order->shipping_method_id = $shipping_method->id;
            $order->save();

            $event = new Event();
            $event->name = 'A new order was create on ' . date("d M Y") . ' at ' . date("h:i:a") . '.';
            $event->order_id = $order->id;
            $event->save();

            foreach ($products as $product) {
                if(rand(1,100) < 50) {
                    $order->products()->attach($product,['quantity' => rand(1,5), 'price' => $product->price]);
                }
            }

            if($order->id == 1) {
                // Make payment code


                // Set to paid and create event
                $order->payment_status = 'paid';
                $order->save();

                $event = new Event();
                $event->name = 'A €' . $order->total() . ' EUR payment was processed on ' . date("d M Y") . ' at ' . date("h:i:a") . '.';
                $event->order_id = $order->id;
                $event->save();


                // Create shipment code

                // Mark as fulfilled and create event
                $order->fulfillment_date = date("Y-m-d");
                $order->fulfillment_status = 'fulfilled';
                $order->save();

                $e = new Event();
                $e->name = 'Order fulfilled - ' . $order->totalItems() . ' item(s).';
                $e->order_id = $order->id;
                $e->save();
            }
        }

    }
}
