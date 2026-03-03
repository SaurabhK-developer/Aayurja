<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymentdetail extends Model
{
    protected $fillable = ['transaction_id','transaction_amount','currency','order_id','name_on_card','card_number','cvc','expiry_month','expiry_year','payment_status'];
}
