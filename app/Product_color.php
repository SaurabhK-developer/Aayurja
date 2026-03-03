<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_color extends Model
{
    protected $fillable = ['product_id','color_id'];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
