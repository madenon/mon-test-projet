<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'content', 'seen'];

    protected $table = 'notification'; // Set the table name

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
