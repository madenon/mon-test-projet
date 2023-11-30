<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposition_id',
        'status',
        'amount',
        'name',
        'date',
    ];

    // Define relationship with Proposition model
    public function proposition():BelongsTo
    {
        return $this->belongsTo(Preposition::class);
    }
}
