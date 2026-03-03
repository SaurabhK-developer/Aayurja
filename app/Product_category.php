<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password 
 * @property string $remember_token
*/
class Product_category extends Authenticatable
{
    use Notifiable;
    use HasRoles;
 protected $table = 'productcategory';
    protected $fillable = ['name','slug','image','shop_page_title','shop_page_desc'];
    

    public function productscat()
    {
        return $this->hasMany(Product_sub_category::class, 'main_cat_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category', 'id'); 
    }
    
}