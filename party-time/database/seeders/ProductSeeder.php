<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => "Plates",
                'product_cat' => 'Product',
                'product_img' => 'https://m.media-amazon.com/images/I/61h9kaO4cFL._AC_SL1500_.jpg',
                'product_price' => '120',
                'product_size_or_qty' => 'Medium',
                'product_description' => 'Those Plates Are Really Cool & Strong Brought From Mountains of China',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Waiters / Day",
                'product_cat' => 'Hireable',
                'product_img' => 'https://www.collinsdictionary.com/images/full/waiter_110620211.jpg',
                'product_price' => '1000',
                'product_size_or_qty' => '',
                'product_description' => 'Those Waiters will serve your guest really well so you can have really good image in your circle',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Glasses",
                'product_cat' => 'Product',
                'product_img' => 'http://newglass.in/wp-content/uploads/2016/06/41TWLrMyoWL.jpg',
                'product_price' => '20',
                'product_size_or_qty' => 'Large',
                'product_description' => 'Those Are From Russia with reallly good texture',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Carpets large Red",
                'product_cat' => 'Product',
                'product_img' => 'https://rugsforyou.in/wp-content/uploads/2021/04/red-printed-flower-carpet-25.jpg',
                'product_price' => '860',
                'product_size_or_qty' => 'Large',
                'product_description' => 'Those Are From Iran with really nice texture and greater soft touch',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Plates",
                'product_cat' => 'Product',
                'product_img' => 'https://m.media-amazon.com/images/I/61h9kaO4cFL._AC_SL1500_.jpg',
                'product_price' => '120',
                'product_size_or_qty' => 'Medium',
                'product_description' => 'Those Plates Are Really Cool & Strong Brought From Mountains of China',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Waiters / Day",
                'product_cat' => 'Hireable',
                'product_img' => 'https://www.collinsdictionary.com/images/full/waiter_110620211.jpg',
                'product_price' => '1000',
                'product_size_or_qty' => '',
                'product_description' => 'Those Waiters will serve your guest really well so you can have really good image in your circle',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Glasses",
                'product_cat' => 'Product',
                'product_img' => 'http://newglass.in/wp-content/uploads/2016/06/41TWLrMyoWL.jpg',
                'product_price' => '20',
                'product_size_or_qty' => 'Large',
                'product_description' => 'Those Are From Russia with reallly good texture',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Carpets large Red",
                'product_cat' => 'Product',
                'product_img' => 'https://rugsforyou.in/wp-content/uploads/2021/04/red-printed-flower-carpet-25.jpg',
                'product_price' => '860',
                'product_size_or_qty' => 'Large',
                'product_description' => 'Those Are From Iran with really nice texture and greater soft touch',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Plates",
                'product_cat' => 'Product',
                'product_img' => 'https://m.media-amazon.com/images/I/61h9kaO4cFL._AC_SL1500_.jpg',
                'product_price' => '120',
                'product_size_or_qty' => 'Medium',
                'product_description' => 'Those Plates Are Really Cool & Strong Brought From Mountains of China',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Waiters / Day",
                'product_cat' => 'Hireable',
                'product_img' => 'https://www.collinsdictionary.com/images/full/waiter_110620211.jpg',
                'product_price' => '1000',
                'product_size_or_qty' => '',
                'product_description' => 'Those Waiters will serve your guest really well so you can have really good image in your circle',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Glasses",
                'product_cat' => 'Product',
                'product_img' => 'http://newglass.in/wp-content/uploads/2016/06/41TWLrMyoWL.jpg',
                'product_price' => '20',
                'product_size_or_qty' => 'Large',
                'product_description' => 'Those Are From Russia with reallly good texture',
                'product_stock' => '1000',
            ],
            [
                'product_name' => "Carpets large Red",
                'product_cat' => 'Product',
                'product_img' => 'https://rugsforyou.in/wp-content/uploads/2021/04/red-printed-flower-carpet-25.jpg',
                'product_price' => '860',
                'product_size_or_qty' => 'Large',
                'product_description' => 'Those Are From Iran with really nice texture and greater soft touch',
                'product_stock' => '1000',
            ],


        ]);
    }
}
