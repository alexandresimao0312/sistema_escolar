<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    //
     protected $fillable = [
        'tipo', 'valor', 'responsavel', 'data', 'observacoes'
    ];

    protected $dates = ['data'];
}
