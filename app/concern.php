<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concern extends Model
{
    protected $fillable = ['title', 'image','slug','shop_page_title','shop_page_desc'];

}