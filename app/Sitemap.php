<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Sitemap extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'sitemaps'; 
    protected $guarded  = [];
}