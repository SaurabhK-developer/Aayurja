<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping_address extends Model
{
    protected $fillable = ['user_id','ssid','address_type','name','email','phone','alt_phone','city','state','apartment','country','address','zip_code','shipping_method','comment'];
}
