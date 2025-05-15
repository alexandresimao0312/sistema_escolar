<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Secretaria extends Authenticatable
{
    use Notifiable;



    protected $fillable = ['nome', 'email', 'password','foto', 'ativo'];

    protected $hidden = [
        'password', 'remember_token',
    ];

}

