<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['title','discount_type','discription','discount_percentage','discount_flat','valid_from','valid_upto','limit_upto','limit_used','active','product'];
}
