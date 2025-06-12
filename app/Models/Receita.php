<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    //
        protected $fillable = [
        'tipo', 'valor', 'origem', 'data', 'observacoes'
    ];

    protected $dates = ['data'];
}
