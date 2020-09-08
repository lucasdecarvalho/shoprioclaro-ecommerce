<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'category', 'caption', 'price', 'storage', 'promo', 'status', 'details', 'image1', 'image2', 'image3'
    ];
}
