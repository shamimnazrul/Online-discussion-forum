<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
    protected $fillable = [
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        'address',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
}
