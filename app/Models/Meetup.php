<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meetup extends Model
{
    use HasFactory;
    protected $fillable = [
        'preposition_id',
        'date',
        'time',
        'description', 
        'status',
        'user_id'
    ];
// get user id from here (Notify about meetup cretion ) 
// get offer id and user id from offer  (and notify him about update )
    // Define relationship with Preposition model
    public function preposition()
    {
        return $this->belongsTo(Preposition::class);
    }
    public static function boot()
    {
        parent::boot();

        static::created(function ($meetup) {
            // Notify about meetup creation
           // $message = 'Une nouvelle rencontre a été créée pour l\'échange :' . $meetup->preposition->name . '".';
           // $meetup->createNotification($meetup->preposition->user_id, $message);
        });

        static::updated(function ($meetup) {
            // Notify about meetup status update
//$message = 'La rencontre pour la proposition : "' . $meetup->preposition->name . '" a été ' . $meetup->status . '".' ;
            //$meetup->createNotification($meetup->preposition->offer->user_id, $message);

            // You can add additional checks here for specific status changes if needed
        });
    }

    public function createNotification($userId, $content)
    {
        // Assuming you have a user_id associated with the preposition

        Notification::create([
            'user_id' => $userId,
            'content' => $content,
            'seen' => false,
        ]);
    }

}
