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
class Product_sub_category extends Authenticatable
{
    use Notifiable;
    use HasRoles;
 //protected $table = 'bank_accounts';
    protected $fillable = ['name','description','category_on_home','banner_on_productgrid','image1','image2','image','slug','main_cat_id'];
    
    

    public function maincat()
    {
        return $this->belongsTo(Product_category::class, 'main_cat_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category', 'id');
    }
   
}
