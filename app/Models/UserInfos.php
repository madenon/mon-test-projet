<?php

namespace App\Models;

use App\Enums\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Validator;




class UserInfos extends Model
{
    use HasFactory;


    
        


    protected $fillable = [
        'user_id', 
        'phone', 
        'gender',
        'bio',
    ];

    protected $hidden = [
        'user_id',
        
    ];

    protected $casts = [
        'gender' => Genre::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
