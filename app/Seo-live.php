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
    protected $fillable = ['url','description','meta_tag','image','keywords','alt_tag','og_url','og_site_name','og_description','og_image','article_schema','canonical_tag','product_schema','Faq_schema'];
}



