<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('g_users')->insert([
            [
                'full_name' => "akshay",
                'email' => 'akshay@gmail.com',
                'phone' => '+6154789652',
                'password' => Hash::make('12345678'),
                'billing_address' => 'Karachi Tariq Road',
                'shipping_address' => 'Karachi Tariq Road Shipping',
            ]
        ]);
    }
}
