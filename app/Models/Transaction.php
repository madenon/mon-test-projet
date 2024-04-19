<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposition_id',
        'offer_id',
        'status',
        'amount',
        'name',
        'date',
        'reason',
        'offeror_status',
        'applicant_status'
    ];

    // Define relationship with Proposition model
    public function proposition():BelongsTo
    {
        return $this->belongsTo(Preposition::class, 'proposition_id', 'id');
    }
    public function offer():BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }
    
    public function disputes(): HasMany
    {
        return $this->hasMany(Dispute::class);
    }
}
