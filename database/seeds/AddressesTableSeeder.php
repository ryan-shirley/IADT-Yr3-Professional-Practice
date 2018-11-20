<?php

use Illuminate\Database\Seeder;
use App\Address;
use App\User;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = User::where('name', 'customer')->first();

        $address = new Address();
        $address->line1 = 'IADT Atrium. Dun Laghaire, Ireland';
        $address->shipping = true;
        $address->billing = false;
        $address->user_id = $customer->id;
        $address->save();

        $address = new Address();
        $address->line1 = '40 Dublin St. Ireland';
        $address->shipping = false;
        $address->billing = true;
        $address->user_id = $customer->id;
        $address->save();
    }
}
