<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    //
    protected $table = 'funcionarios' ;
    protected $fillable = ['nome', 'cargo', 'salario_base', 'contratado_em','email','telefone'];

    public function salarios()
    {
        return $this->hasMany(Salario::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function documentosEmitidos()
    {
        return $this->hasMany(Documento::class, 'emitido_por');
    }

}
