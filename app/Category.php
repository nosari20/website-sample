<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;


    public function pages()
    {
        return $this->hasMany('App\Page');
    }
}
