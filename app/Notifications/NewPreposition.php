<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use App\Models\Preposition;
use App\Models\User;
use Illuminate\Support\HtmlString;



class NewPreposition extends Notification
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
                    ->subject('Nouvelle Proposition')
                    ->greeting('Bonjour '. $this->preposition->offer->user->name)
                    ->line('Vous avez reçu une nouvelle proposition sur l\'offre :' . $this->preposition->offer->title )
                    ->action('Voir la proposition', $url)
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
            'name' => $this->preposition->user->name,
            'title' => $this->preposition->name,
            'content' => ' vous a envoyé une proposition',
            'link' => url('/offres/'.$this->preposition->offer->id.'/'.$this->preposition->offer->slug)
        ];
    }
}
