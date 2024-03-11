<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Preposition;
use App\Models\User;

class PropositionResult extends Notification
{
    use Queueable;

    private Preposition $preposition; 

    public function __construct($prep)
    {
        $this->preposition = $prep;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/propositions');
        return (new MailMessage)
                    ->subject('Résultat de la proposition')
                    ->line('L\'état de votre proposition a été mis à jour')
                    ->action('Voir la Proposition', $url)
                    ->line($this->preposition->name);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->preposition->id,
            'name' => $this->preposition->offer->user->first_name . ' ' . $this->preposition->offer->user->last_name,
            'title' => $this->preposition->name,
            'content' => 'a '.$this->preposition->status.' votre proposition',
            'link' => url('/propositions')
        ];
    }
}
