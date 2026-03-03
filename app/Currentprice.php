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
class Currentprice extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = ['material_id','purity_id','current_price','updated_at'];
    
    protected $table = 'currentprice';



    
    public function material()
    { 
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function purity()
    { 
        return $this->belongsTo(Metalpurity::class, 'purity_id');
    }
    
    
   
    
}