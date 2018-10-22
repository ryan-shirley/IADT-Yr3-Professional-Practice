<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->description = 'An Administrator';
        $admin->save();

        $artist = new Role();
        $artist->name = 'artist';
        $artist->description = 'An Artist';
        $artist->save();

        $customer = new Role();
        $customer->name = 'customer';
        $customer->description = 'A customer';
        $customer->save();
    }
}
