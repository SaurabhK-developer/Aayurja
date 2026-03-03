<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class Formtype extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'form_type'; 
    protected $guarded  = [];

    public function dynamicEmails()
    {
        return $this->hasMany(Dynamicemail::class, 'form_type_id');
    }
}
