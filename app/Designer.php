<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    protected $fillable = ['designer_name','description','logo','image','updated_by','approved','slug'];
}
