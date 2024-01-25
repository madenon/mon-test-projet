<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Preposition;


class PropositionConfirmation extends Notification
{
    use Queueable;

    private Preposition $preposition; 

    public function __construct($prep)
    {
        $this->preposition=$prep;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [ 'database','broadcast'];
        // return ['mail', 'database','broadcast'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/propositions');
        return (new MailMessage)
                    ->subject('Proposition confirmation')
                    ->line('Please confirm your proposition')
                    ->action('View Proposition', $url)
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
            'name' =>   $this->preposition->offer->user->name,
            'title' =>   $this->preposition->name,
            'content' => 'has '.$this->preposition->status.' your proposition. Please confirm it',
            'link' => url('/propositions')

        ];
    }
}
