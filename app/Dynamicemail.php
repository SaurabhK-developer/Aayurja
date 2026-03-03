<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class Dynamicemail extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'dynamicemails';

    // protected $gaurded = [];
    protected $fillable = [
        'to_emails',
        'cc_emails',
        'bcc_emails',
        'email_types',
        'form_type_id',  
    ];

    public function Formtype()
    {
        return $this->belongsTo(Formtype::class, 'form_type_id');
    }

    

}



