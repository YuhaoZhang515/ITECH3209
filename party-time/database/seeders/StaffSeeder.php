<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            [
                'full_name' => "kumar",
                'email' => 'kumar@gmail.com',
                'phone' => '03063092274',
                'password' => Hash::make('12345678'),
            ]
        ]);
    }
}
