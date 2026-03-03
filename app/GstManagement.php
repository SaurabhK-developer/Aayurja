<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GstManagement extends Model
{
    protected $guarded = [];
    protected $table = "gstmanagements";

    public function product(){
        return $this->belongsTo(Product::class);
     }

}
