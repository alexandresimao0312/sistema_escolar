<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //
    protected $table = 'cursos' ;

    protected $fillable = ['nome', 'tipo','valor_mensalidade', 'ativo'];

    public function classes() {
        return $this->hasMany(Classe::class);
    }

    public function alunos() {
        return $this->hasMany(Aluno::class);
    }

    public function disciplinas() {
        return $this->hasMany(Disciplina::class);
    }

    public function turmas() {
        return $this->hasMany(Turma::class);
    }
    public function ajustesMensalidade()
{
    return $this->hasMany(AjusteMensalidade::class);
}

}
