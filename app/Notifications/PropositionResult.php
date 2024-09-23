<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Preposition;
use App\Models\User;
use Illuminate\Support\HtmlString;

class PropositionResult extends Notification
{
    use Queueable;

    private Preposition $preposition; 
    private User $taker;

    public function __construct($prep,$taker)
    {
        $this->preposition = $prep;
        $this->taker=$taker;
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
                    ->greeting('Bonjour '. $this->taker->name)
                    ->line('L\'état de votre proposition a été mis à jour sur l\'offre :' . $this->preposition->offer->title)
                    ->action('Voir la Proposition', $url)
                    ->line(new HtmlString('Merci de consulter votre compte sur <a href="https://darkorange-wolf-733627.hostingersite.com/">faistroquer.fr</a> pour avoir plus d\'informations à propos de sa proposition.'));

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
            'name' => $this->preposition->offer->user->name,
            'title' => $this->preposition->name,
            'content' => 'a '.$this->preposition->status.' votre proposition',
            'link' => url('/propositions')
        ];
    }
}
