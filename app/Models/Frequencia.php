<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
    //
    protected $table = 'frequencias' ;
    
    protected $fillable = ['aluno_id', 'disciplina_id', 'data', 'presente'];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }

    public function disciplina() {
        return $this->belongsTo(Disciplina::class);
    }
}
