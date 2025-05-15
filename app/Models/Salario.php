<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    //

    protected $table = 'salarios' ;
    protected $fillable = ['funcionario_id', 'mes', 'ano', 'valor_pago', 'data_pagamento'];

    public function funcionario() {
        return $this->belongsTo(Funcionario::class);
    }
}
