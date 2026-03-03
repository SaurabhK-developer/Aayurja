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
class Style extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = ['name','slug'];
    protected $table = 'style';


    
    public function productscat()
    {
        return $this->hasMany(Product_category::class, 'main_cat_id', 'id');
    }
}
