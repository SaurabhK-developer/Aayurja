<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class Seo extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $guarded = ['id'];
}



