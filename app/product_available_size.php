<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_available_size extends Model
{
    protected $fillable = ['productid','sizes','price','discount','discounted_price','status'];
}
