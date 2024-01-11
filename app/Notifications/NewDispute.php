<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Dispute;

class NewDispute extends Notification
{
    use Queueable;

    private Dispute $dispute; 

    public function __construct($dis)
    {
        $this->dispute=$dis;
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
        $url = url('/admin/disputes/');
        return (new MailMessage)
                    ->subject('New Report')
                    ->line('You have receiveid a new dispute.')
                    ->action('View Report', $url)
                    ->line($this->dispute->description);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->dispute->id,
            'name' =>   $this->dispute->disputer->name,
            'title' => $this->dispute->title,
            'content' => ' send a dispute',
            'link' => url('/admin/disputes/'.$this->dispute->disputer_id)
        ];
    }
    
    
}
