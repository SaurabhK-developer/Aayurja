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
class Offer extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guarded = [];
    
    public function getDiscountAttribute($value)
    {
        if (!empty(session('currencyfactor')) && $this->global_offer_type == 1) {
            return round($value * session('currencyfactor'), 2);
        } else {
            return $value;
        }
    }
    
    public function getPurchaseAmountAttribute($value)
    {
        if (!empty(session('currencyfactor'))) {
            return round($value * session('currencyfactor'), 2);
        } else {
            return $value;
        }
    }
    
}
