<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Ror  extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'rors'; 
    protected $guarded  = [];
}