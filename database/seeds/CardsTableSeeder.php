<?php

use Illuminate\Database\Seeder;
use App\Card;
use App\User;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = User::where('name', 'customer')->first();

        $card = new Card();
        $card->name_on_card = 'Customer Card';
        $card->number = '1234567890123456';
        $card->expiry = '12/10/2020';
        $card->user_id = $customer->id;
        $card->save();
    }
}
