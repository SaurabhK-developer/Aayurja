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
class Deal extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = ['product_id','discount','start_date','end_date','image','previous_discount','status'];
    
    public function product()   
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}