<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $table = 'posts';

    public function post_categories()
    {
        return $this->belongsTo('App\PostCategories','id_categories','id');
    }
}
