<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    //
    protected $table = 'turmas' ;

    protected $fillable = ['nome', 'curso_id', 'ano','classe_id'];

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

    public function alunos() {
        return $this->belongsToMany(Aluno::class, 'turma_aluno')->withTimestamps();
    }

    public function professores() {
        return $this->belongsToMany(Professor::class, 'turma_professor')->withTimestamps();
    }

    public function matriculas() {
        return $this->hasMany(Matricula::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
