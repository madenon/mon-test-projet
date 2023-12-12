<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Preposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'offer_id',
        'status',
        'negotiation',
        'confirmed_at',
        'user_id',
        'price',
        'images',
    ];
    public static function boot()
    {
        parent::boot();
    
        static::created(function ($preposition) {
            // Notification when a preposition is added
           // $preposition->createNotification('', 'Your proposition has been added.');
        });
    
        static::updated(function ($preposition) {
            // Notification when a preposition is updated
            if ($preposition->status == 'accepted') {
                $message = 'La proposition :'.$preposition->name. ' est accepté';
            } else {
                $message = 'La proposition :'.$preposition->name. ' est rejeté';
            }
            $preposition->createNotification($preposition->user_id, $message);
        });
    
        // You can add similar logic for accepted and rejected events
    }    

    public function createNotification($userId, $content)
    {
        Notification::create([
            'user_id' => $userId,
            'content' => $content,
            'seen' => false,
        ]);
    }

    
    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
    public function meetup()
    {
        return $this->hasOne(Meetup::class, 'preposition_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function transactions():HasMany
{
    return $this->hasMany(Transaction::class, 'proposition_id', 'id');
}
public function chmessages(): HasMany
{
    return $this->hasMany(ChMessage::class);
}
}
