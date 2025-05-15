<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    //

    protected $table = 'professors' ;
    protected $fillable = ['nome', 'email', 'telefone', 'disciplina_principal'];

    public function turmas() {
        return $this->belongsToMany(Turma::class, 'turma_professor')->withTimestamps();
    }
}
