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
class Subcategory extends Authenticatable
{
    use Notifiable;
    use HasRoles;
 //protected $table = 'bank_accounts';
    protected $fillable = ['name','category_id','slug'];
    
    
   
    public function Category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }
    
}