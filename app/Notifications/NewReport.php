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
        $this->report=$rep;
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
        $url = url('/admin/reports/');
        return (new MailMessage)
                    ->subject('New Report')
                    ->line('You have receiveid a new report.')
                    ->action('View Report', $url)
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
            'name' =>   $this->report->reporter->name,
            'title' => $this->report->title,
            'content' => ' send a report',
            'link' => url('/admin/reports/'.$this->report->reporter_id)
        ];
    }
    
    
    

}
