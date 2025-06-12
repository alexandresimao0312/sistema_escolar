<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    //
    protected $fillable = [
        'tipo', 'valor', 'descricao', 'data'
    ];

    protected $dates = ['data'];
}
