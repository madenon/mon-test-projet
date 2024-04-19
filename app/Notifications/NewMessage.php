<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ChMessage as Message;
use App\Models\User;

class NewMessage extends Notification implements ShouldQueue
{
    use Queueable;

    private Message $message; 
    private User $sender;

    public function __construct($mes)
    {
        $this->message = $mes;
        $this->sender = User::find($mes->from_id);
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
        $url = url('/moncompte/mesmessages/'.$this->message->from_id);
        return (new MailMessage)
                    ->subject('Nouveau Message')
                    ->line('Vous avez reçu un nouveau message.')
                    ->action('Voir le Message', $url)
                    ->line($this->message->body);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->message->id,
            'from_id' => $this->sender->id,
            'name' => $this->sender->name,
            'content' => 'vous a envoyé un message',
            'link' => url('/moncompte/mesmessages/'.$this->message->from_id)
        ];
    }
}
