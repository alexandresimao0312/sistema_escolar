<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    //

    protected $table = 'mensalidades' ;

    protected $fillable =
     [
    'matricula_id',
    'mes',
    'ano',
    'valor',
    'estado',
    'data_vencimento',
    'data_pagamento',
];


     // 🔁 Acesso direto ao aluno via matricula
     public function aluno()
     {
         return $this->matricula ? $this->matricula->aluno() : null;
     }

    // 🔁 Relacionamento com matrícula

    public function matricula()
{
    return $this->belongsTo(Matricula::class);
}
public function mensalidade()
{
    return $this->belongsTo(Mensalidade::class);
}
public function alunos()
{
    return $this->belongsTo(Aluno::class);
}
public function pagamentos()
{
    return $this->hasMany(Pagamento::class);
}


}
