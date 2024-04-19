<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'rated_by_user_id', 
        'stars',
        'feedback',
        'preposition_id',
        'transaction_id'
    ];

    public function rated()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rater()
    {
        return $this->belongsTo(User::class, 'rated_by_user_id');
    }
}
