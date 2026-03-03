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
class Rating extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guarded = [];
    protected $table = 'rating';



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}