<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;


class Contact extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = 'contacts';
    protected $fillable = ['name','email','services','source_url','mobile','message','product','product_weight','product_quantity','interested_in','person','formtype'];
    
    
}