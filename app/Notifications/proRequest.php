<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\HtmlString;


class proRequest extends Notification
{
    use Queueable;

    private User $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $url = url('/admin/pro');
        return (new MailMessage)
                    ->subject('Nouvelle demande de compte Pro')
                    ->greeting('Bonjour ')
                    ->line('Vous avez une nouvelle demande de compte pro venant de ' . $this->user->mail. ". Veuillze traiter la demande ")
                    ->action('Voir la demande ', $url)
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
            'id' => $this->user->id,
            'name' => 'Demande de compte pro',
            'title' => $this->user->email,
            'content' => 'Vous avez une nouvelle demande de compte pro venant de ',
            'link' => url('/admin/pro')
        ];
    }
}
