<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
