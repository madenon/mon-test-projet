<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\HtmlString;

class NewBadge extends Notification
{
    use Queueable;
    protected User $user;
    protected $badge;
    

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, $badge)
    {
        $this->user = $user;
        $this->badge = $badge;
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
        $url = url('/');
        return (new MailMessage)
                    ->subject($this->badge == "ContestWinner"? "Le gagnant du constest" : "Le bagde")
                    ->greeting('Bonjour,')
                    ->line('Le gagant du contest de la periode est '.$this->user->email)
                    ->action('Participer et gagner', $url)
                    ->line(new HtmlString('Merci de consulter votre compte sur <a href="https://darkorange-wolf-733627.hostingersite.com/">faistroquer.fr</a> pour tenter de gagner la prochaine fois.'));
                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->user->id,
            'name' => $this->badge == "ContestWinner"? "Le gagnant du constest actuel" : "Le bagde",
            'title' => "Participer",
            'content' => "est ". $this->user->email,
            'link' => url('/')
        ];
    }
}
