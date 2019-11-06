<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactSettings extends Model
{
    //
    protected $table = 'contact_settings';

    protected $casts = [
        'phone' => 'array',
        'email' => 'array',
    ];
}
