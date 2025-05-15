<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NovoAlunoMatriculado extends Notification
{
    use Queueable;

    protected $aluno;

    public function __construct($aluno)
    {
        $this->aluno = $aluno;
    }

    public function via($notifiable)
    {
        return ['database']; // Guarda no banco
    }

    public function toDatabase($notifiable)
    {
        return [
            'titulo' => 'Novo Aluno Matriculado',
            'mensagem' => "O aluno {$this->aluno->nome} foi matriculado com sucesso.",
            'aluno_id' => $this->aluno->id,
        ];
    }
}

