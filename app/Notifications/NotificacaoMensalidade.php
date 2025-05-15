<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificacaoMensalidade extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $mensalidade;
    protected $aluno;

    public function __construct($mensalidade, $aluno)
    {
        //
        $this->mensalidade = $mensalidade;
        $this->aluno = $aluno;
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
        ->subject('Nova Mensalidade Disponivel!')
        ->greeting("Olá, {$this->aluno->nome}!")
        ->line("**Foi gerada uma nova mensalidade referente ao mês:** {$this->mensalidade->mes}/{$this->mensalidade->ano} ")
        ->line("**No Valor De:** { \Carbon\Carbon::parse({$this->mensalidade->valor}), 2, ',', '.') }} KZ ")
        ->line("**Data de Vencimento:** { \Carbon\Carbon::parse({$this->mensalidade->data_vencimento})->format('d/m/Y') } ")
        ->line("Por Favor Paga A Sua Mensalidade Antes Da Data.")
        ->action('Notification Action', url('/portal'))
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
