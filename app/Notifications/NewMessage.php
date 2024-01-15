<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
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
        $this->message=$mes;
        $this->sender=User::find($mes->from_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return['database','broadcast'];
        // return ['mail', 'database','broadcast'];
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/moncompte/mesmessages/'.$this->message->from_id);
        return (new MailMessage)
                    ->subject('New Message')
                    ->line('You have receiveid a new message.')
                    ->action('View Message', $url)
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
            'name' =>   $this->sender->name,
            'content' => ' send you a message',
            'link' => url('/moncompte/mesmessages/'.$this->message->from_id)
        ];
    }
    
    
    

}
// href="{{route('offer.offer', [$preposition->offer, urlencode($preposition->offer->slug)])}}"