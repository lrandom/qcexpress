<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $casts = [
        'photo' => 'array',
    ];
}
