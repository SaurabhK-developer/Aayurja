<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;


class flavourmappings extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    
    protected $table = 'flavourmappings';
    protected $guarded = [];
    public $timestamps = false;
    
    public function productdetails()
    {
        return $this->belongsTo(Product::class, 'productid');
    }

    public function flavorimage() 
    {
        return $this->belongsTo(Product_Image::class, 'image_id');
    }
}
