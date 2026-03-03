<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class Altimage extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $fillable = ['url','tagname'];
}



