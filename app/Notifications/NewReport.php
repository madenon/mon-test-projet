<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Report;
use App\Models\User;

class NewReport extends Notification
{
    use Queueable;

    private Report $report; 

    public function __construct($rep)
    {
        $this->report = $rep;
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
        $url = url('/admin/reports/');
        return (new MailMessage)
                    ->subject('Nouveau Signalement')
                    ->line('Vous avez reçu un nouveau signalement.')
                    ->action('Voir le Signalement', $url)
                    ->line($this->report->description);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->report->id,
            'name' => $this->report->reporter->name,
            'title' => $this->report->title,
            'content' => 'a envoyé un signalement',
            'link' => url('/admin/reports')
        ];
    }
}
