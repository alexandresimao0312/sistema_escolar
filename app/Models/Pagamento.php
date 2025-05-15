<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagamento extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'mensalidade_id',
        'data_pagamento',
        'valor_pago',
        'forma_pagamento',
        'referencia',   
        'comprovativo_path',

    ];

    public function mensalidade()
    {
        return $this->belongsTo(Mensalidade::class);
    }
    public function mensalidades()
{
    return $this->belongsToMany(Mensalidade::class, 'mensalidade_pagamento');
}
}
