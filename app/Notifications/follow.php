<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class follow extends Notification
{
    use Queueable;

    protected User $follower;
    protected bool $is_following;

    public function __construct($follower, $is_following)
    {
        $this->follower = $follower;
        $this->is_following = $is_following;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $followerName = $this->follower->name; // Assuming $follower has a 'name' attribute

        $subject = $followerName . ($this->is_following ? ' vous suit ' : ' ne vous suit plus ');

        return (new MailMessage)
                    ->subject($subject)
                    ->line($followerName . ($this->is_following ? ' vous suit' : ' ne vous suit plus'));

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->follower->id,
            'content' => $this->follower->name. ($this->is_following ? ' vous suit' : ' ne vous suit plus'),
            'link' => url('/moncompte')
        ];
    }
}
