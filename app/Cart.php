<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Cart extends Authenticatable
{
  use Notifiable;
    use HasRoles;
  protected $guarded = ['id'];

    protected $table = "carts";

    
    public function user(){
       return $this->belongsTo(User::class);
    }

    public function product(){
       return $this->belongsTo(Product::class);
    }


    public function sizes(){
      return $this->belongsTo(Size::class,'size_id','id');
   }

    public function product_weight()
    {
        return $this->belongsTo(Size::class, 'weight');
    }
    public function firstimageone()
    {
        return $this->belongsTo(Product_Image::class, 'product_id', 'product_id')->orderBy('id', 'asc');
    }
    
    public function productsizetable(){
      return $this->belongsTo(product_available_size::class, 'size_id','id');
    }
    
    public function productprice(){
        return $this->hasMany(ProductVariants::class,'product_id','product_id');
      }

      public function product_variants()
      {
          return $this->belongsTo(ProductVariants::class, 'product_variants_id');
      }

    
    // public function productsizetable(){
    //   return $this->hasMany(product_available_size::class);
    // }
}
