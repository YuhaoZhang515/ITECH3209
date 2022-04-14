<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_cat',
        'product_img',
        'product_size_or_qty',
        'product_price',
        'product_description',
        'product_stock'
    ];
}
