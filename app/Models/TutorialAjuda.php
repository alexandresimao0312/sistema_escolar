<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorialAjuda extends Model
{
    //
    protected $fillable = ['titulo', 'descricao', 'conteudo', 'video_url', 'categoria'];
}
