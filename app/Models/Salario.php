<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    //
    protected $table = 'salarios';
    protected $fillable = ['funcionario_id', 'cargo','descontos','bonus','salario_base','total_recebido','referente_mes'];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

}
