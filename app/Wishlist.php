<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

    protected $table = "whishlists";

    protected $guarded = [];
    public function user(){
       return $this->belongsTo(User::class);
    }

    public function product(){
       return $this->belongsTo(Product::class);
    }

    public function product_sizet()
    {
        return $this->belongsTo(Size::class, 'size');
    }
    // public function product_variants()
    // {
    //     return $this->belongsTo(ProductVariants::class, 'chosenweight');
    // }

    public function product_variants()
    {
        return $this->belongsTo(ProductVariants::class, 'product_id', 'product_id');
    }

    // public function product_variants()
    // {
    //     return $this->hasMany(ProductVariants::class, 'product_id', 'product_id');
        
    // }

    public function firstimagewishlist()
    {
        return $this->belongsTo(Product_Image::class, 'product_id', 'product_id');
        // return $this->belongsTo(Product_Image::class, 'product_id', 'product_id')->orderBy('id', 'asc');
    }


}
