<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppRegistrant extends Model
{
    //

    protected $fillable = [
        'app',
        'role_id'
    ];
}
