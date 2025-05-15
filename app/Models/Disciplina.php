<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    //
    protected $table = 'disciplinas' ;
    
    protected $fillable = ['nome', 'carga_horaria', 'curso_id'];

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

    public function avaliacoes() {
        return $this->hasMany(Avaliacao::class);
    }

    public function medias() {
        return $this->hasMany(Media::class);
    }

    public function frequencias() {
        return $this->hasMany(Frequencia::class);
    }
}
