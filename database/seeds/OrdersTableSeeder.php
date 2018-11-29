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
        // $p1 = Product::where('name', 'Product 1')->first();
        // $p2 = Product::where('name', 'Product 2')->first();
        $products  = Product::all();

        for($i = 0; $i < 3; $i++) {
            $order = new Order();
            $order->user_id = 3;
            $order->order_date = $this->randomDate();;
            $order->payment_status = 2;
            $order->fulfillment_status = 2;
            $order->shipping_address = $shipping->line1;
            $order->billing_address = $billing->line1;
            $order->shipping_method_id = $shipping_method->id;
            $order->save();

            foreach ($products as $product) {
                if(rand(1,100) < 50) {
                    $order->products()->attach($product,['quantity' => rand(1,5), 'price' => $product->price]);
                }
            }
        }

        // $order->products()->attach($p1,['quantity' => 1, 'price' => 10]);

    }

    // this method generates random date in format yyyy-mm-dd
    private function randomDate() {
        $start = new DateTime('2017-01-01');
        $end = new DateTime('2017-12-31');
        $randomTimestamp = mt_rand($start->getTimestamp(), $end->getTimestamp());
        $randomDate = new DateTime();
        $randomDate->setTimestamp($randomTimestamp);
        return $randomDate->format('Y-m-d');
    }
}
