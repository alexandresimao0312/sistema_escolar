<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    //

    protected $table = 'classes' ;

    protected $fillable = ['nome', 'curso_id'];

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

    public function alunos() {
        return $this->hasMany(Aluno::class);
    }
    public function ajustesMensalidade()
{
    return $this->hasMany(AjusteMensalidade::class);
}
}
