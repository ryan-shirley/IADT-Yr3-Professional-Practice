<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_artist = Role::where('name', 'artist')->first();
        $role_customer = Role::where('name', 'customer')->first();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $artist = new User();
        $artist->name = 'Artist';
        $artist->email = 'artist@example.com';
        $artist->password = bcrypt('secret');
        $artist->save();
        $artist->roles()->attach($role_artist);

        $customer = new User();
        $customer->name = 'Customer';
        $customer->email = 'customer@example.com';
        $customer->password = bcrypt('secret');
        $customer->save();
        $customer->roles()->attach($role_customer);
    }
}
