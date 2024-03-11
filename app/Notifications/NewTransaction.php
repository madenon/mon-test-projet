<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use App\Models\Transaction;
use App\Models\User;

class NewTransaction extends Notification
{
    use Queueable;
    private Transaction $transaction; 

    public function __construct($trans)
    {
        $this->transaction=$trans;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database','broadcast'];
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/transactions');
        return (new MailMessage)
        ->subject('Nouvelle Transaction')
        ->line('Vous avez reçu une nouvelle transaction.')
        ->action('Voir la Transaction', $url)
        
                    ->line($this->transaction->name);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->transaction->id,
            'name' =>   $this->transaction->proposition->offer->user->first_name . ' '. $this->transaction->proposition->offer->user->last_name ,
            'title' =>   $this->transaction->name,
            'content' => 'a '.$this->transaction->status.' votre transaction',
            'link' => url('/transactions')   
        ];
    }
    
    
    
}
