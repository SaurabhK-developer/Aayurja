<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = ['txnid','transaction_amount','transation_code','ssid','user_id','payment_source','payment_id','payment_type','status','order_id','reference_no'];
}
