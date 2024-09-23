<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropositionImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposition_photo',
        'proposition_id',
        'photo_path_type', 
    ];

    public function proposition(): BelongsTo
    {
        return $this->belongsTo(Preposition::class);
    }
}
