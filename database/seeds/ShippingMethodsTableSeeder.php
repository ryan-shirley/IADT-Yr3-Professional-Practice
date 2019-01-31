<?php

use Illuminate\Database\Seeder;
use App\ShippingMethod;

class ShippingMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipping_method = new ShippingMethod();
        $shipping_method->name = 'Standard';
        $shipping_method->description = '(3-5 Days)';
        $shipping_method->cost = 0.00;
        $shipping_method->save();

        $shipping_method = new ShippingMethod();
        $shipping_method->name = 'Express';
        $shipping_method->description = '(1-2 Days)';
        $shipping_method->cost = 10.00;
        $shipping_method->save();
    }
}
