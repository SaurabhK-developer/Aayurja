<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class ProductVariants extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $table = 'product_variants';
    protected $guarded = [];
    public $timestamps = false;

  


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
