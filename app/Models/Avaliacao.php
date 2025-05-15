<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    //
    protected $table = 'avalicaos' ;

    protected $fillable = ['aluno_id', 'disciplina_id', 'nota', 'tipo'];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }

    public function disciplina() {
        return $this->belongsTo(Disciplina::class);
    }
}
