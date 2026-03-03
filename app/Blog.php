<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class Blog extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = ['title','slug','created_at','category','description','slug','image','image1','image2','author_id'];
    
  
     public function author()   
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function user()   
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    
    public function tag(){
      return $this->belongsTo(Tag::class, 'tags');
    }

      
    public function category_data()
    { 
        return $this->belongsTo(Category::class, 'category');
    }
    
    
   
    
}