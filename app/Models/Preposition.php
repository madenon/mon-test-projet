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
