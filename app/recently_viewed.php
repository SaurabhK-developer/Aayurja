<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class recently_viewed extends Authenticatable
{
    protected $guarded = [];
    protected $table = 'quick_view_timestamps';
    
     public function product_details()
    {
        return $this->belongsTo(Product::class, 'productid');
    }


    public function firstimage()
    {
        return $this->belongsTo(Product_Image::class, 'id', 'product_id')->orderBy('id', 'asc');
    }
}