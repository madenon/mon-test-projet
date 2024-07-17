<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\HtmlString;

class NewTransaction extends Notification
{
    use Queueable;
    private Transaction $transaction;
    private User $taker;

    public function __construct($trans,$taker)
    {
        $this->transaction=$trans;
        $this->taker=$taker;
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
        ->greeting('Bonjour '. $this->taker->name)
        ->line('Vous avez reçu une nouvelle transaction.')
        ->action('Voir la Transaction', $url)
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
            'id' => $this->transaction->id,
            'title' =>   $this->transaction->name,
            'content' => 'Vous avez reçu une nouvelle transaction. ',
            'link' => url('/transactions')   
        ];
    }
    
    
    
}
