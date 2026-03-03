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
class Occasion extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = ['name','slug','image','image1','approved'];
    
    
    
     public function category()
    {
        return $this->belongsTo(Product_category::class,'category_id');
    }
    /**
     * Hash password
     * @param $input
     */
   
    
}
