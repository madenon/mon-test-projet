<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Gender;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class UserInfos extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_id', 
        'phone', 
        'gender',
        'bio',
        'nickname',
    ];

    protected $hidden = [
        'user_id',
        
    ];

    protected $casts = [
        'gender' => Gender::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}