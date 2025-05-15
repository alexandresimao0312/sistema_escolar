<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //
    protected $table = 'documentos';

        protected $fillable = [
            'titulo',
            'tipo',
            'aluno_id',
            'funcionario_id',
            'caminho_arquivo',
            'emitido_por',
            'data_emissao',
            'observacoes',
        ];
    
        public function aluno()
        {
            return $this->belongsTo(Aluno::class);
        }
    
        public function funcionario()
        {
            return $this->belongsTo(Funcionario::class);
        }
    
        public function emissor()
        {
            return $this->belongsTo(Funcionario::class, 'emitido_por');
        }
}
