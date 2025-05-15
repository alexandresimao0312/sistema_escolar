<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AjusteMensalidade extends Model
{
    //
    protected $table = 'ajuste_mensalidades';

    protected $fillable = [
        'curso_id', 'classe_id', 'ajuste'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
