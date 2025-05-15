<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAtividade extends Model
{
    //
    protected $table = 'logs';

    protected $fillable = [
        'secretaria_id',
        'acao',
        'entidade_afetada',
        'id_entidade',
        'detalhes'
    ];

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }
}
