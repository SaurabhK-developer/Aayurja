<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbandonedCart extends Model
{
    protected $table = 'abandoned_carts';
    protected $guarded = []; 
}
