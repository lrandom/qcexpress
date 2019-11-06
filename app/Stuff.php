<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    protected $primaryKey = 'id'; // or null

    public $incrementing = false;
}
