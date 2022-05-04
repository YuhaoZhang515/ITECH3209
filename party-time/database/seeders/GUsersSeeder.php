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
                'full_name' => "Yuhao.Zhang",
                'email' => 'zhangyuhao@gmail.com',
                'phone' => '0449660201',
                'password' => Hash::make('12345678'),
                'billing_address' => 'Adelaide Road',
                'shipping_address' => 'Adelaide Road',
            ]
        ]);
    }
}
