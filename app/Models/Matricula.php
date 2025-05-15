<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    //
    protected $table = 'matriculas' ;
    protected $fillable = ['aluno_id', 'curso_id', 'turma_id', 'data_matricula', 'estado','turno','classe_id'];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

    public function turma() {
        return $this->belongsTo(Turma::class);
    }
    public function classe() {
        return $this->belongsTo(Classe::class);
    }
    public function mensalidades()
{
    return $this->hasMany(Mensalidade::class);
}
}
