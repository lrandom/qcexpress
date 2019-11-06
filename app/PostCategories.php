<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    //
    protected $table = 'post_categories';

    public function posts()
    {
        return $this->hasMany('App\Posts','id_categories','id');
    }
}
