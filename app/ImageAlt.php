<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class ImageAlt extends Authenticatable
{

    use Notifiable;
    use HasRoles;

    protected $table = 'image_alts';
    protected $fillable = [
        'file_name', 
        'total_images', 
        'images_with_alt', 
        'images_without_alt',
        'image_sources', 
        'images_with_null_alt', 
        'image_sources_with_null_alt' 
    ];
}


