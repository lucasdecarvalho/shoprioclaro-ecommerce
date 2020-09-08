<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'address','price','fmt_price','ship','fmt_ship','final','fmt_final'
    ];
}
