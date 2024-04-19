<?php

namespace App\Notifications;

use App\Models\Preposition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\HtmlString;

class NewMeetUp extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    private User $taker;
    private Preposition $preposition;

    public function __construct($prop,$taker)
    {
        $this->taker=$taker;
        $this->preposition=$prop;
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
        ->subject('Nouvelle rendez-vous')
        ->greeting('Bonjour '. $this->taker->first_name)
        ->line('Vous avez reçu un rendez-vous sur la proposition '. $this->preposition->name)
        ->action('Voir la proposition', $url)
        ->line(new HtmlString('Merci de consulter votre compte sur <a href="https://darkorange-wolf-733627.hostingersite.com/">faistroquer.fr</a> pour avoir plus d\'informations.'));
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
            'title' => $this->preposition->name,
            'content' => 'Vous avez un nouveau rendez-vous concernant la proposition: ',
            'link' => url('/offres/'.$this->preposition->offer->id.'/'.$this->preposition->offer->slug)
        ];
    }
}
