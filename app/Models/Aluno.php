<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Aluno extends Model
{
    //

    use Notifiable;

    protected $table = 'alunos' ;

    protected $fillable = ['nome', 'email', 'data_nascimento', 'telefone', 'endereco','nif'];

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

    public function classe() {
        return $this->belongsTo(Classe::class);
    }

    public function mensalidades() {
        return $this->hasMany(Mensalidade::class);
    }

    public function matriculas() {
        return $this->hasMany(Matricula::class);
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

    public function turmas() {
        return $this->belongsToMany(Turma::class, 'turma_aluno')->withTimestamps();
    }
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
