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
        'status'
    ];

    // Define relationship with Preposition model
    public function preposition()
    {
        return $this->belongsTo(Preposition::class);
    }
}
