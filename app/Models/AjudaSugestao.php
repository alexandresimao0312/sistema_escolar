<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AjudaSugestao extends Model
{
    //
     protected $fillable = ['pergunta', 'resposta', 'ip', 'user_type', 'user_id'];

    public function user()
    {
        return $this->morphTo();
    }
}
