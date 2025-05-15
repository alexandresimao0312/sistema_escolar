<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificacaoMatricula extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $matricula;
    protected $aluno;
    protected $curso;
    protected $classe;
    protected $turma;

    public function __construct($matricula, $aluno, $curso, $classe, $turma)
    {
        //
        $this->matricula = $matricula;
        $this->aluno = $aluno;
        $this->curso = $curso;
        $this->turma = $turma;
    }
   

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Matrículas Registrada!')
        ->greeting("Olá, {$this->aluno->nome}!")
        ->line("A Sua Matrícula Foi Registrada Com Sucesso.")
        ->line("**No Curso:** {$this->curso->nome}")
        ->line("**Na Turma:** {$this->turma->nome}")
        ->line("**No Periodo de :** {$this->matricula->turno}")
        ->line("Se não reconhecer esta Registro de Matrículas, entre em contato com as autoridades.")
        ->action('Ver Detalhes', url('/site/consulta'))
        ->salutation('Atenciosamente, Colegio Eugenia Gonsalves');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
