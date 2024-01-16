<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Contest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'type',
        'value',
        'price',
        'start_datetime',
        'end_datetime',
        'description',
    ];
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    
}
