<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Robots  extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'robots'; 
    protected $guarded  = [];
}