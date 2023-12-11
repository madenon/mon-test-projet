<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;
use App\Models\Rating;
use App\Models\Following;


class User extends Authenticatable  implements MustVerifyEmail
{
        use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
        'last_name',
        'first_name',
        'profile_photo_path',
        'is_online',
        'avatar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'password' => 'hashed',
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
           'id'         => Where::class,
           'name'       => Like::class,
           'email'      => Like::class,
           'updated_at' => WhereDateStartEnd::class,
           'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function getIsOnlineAttribute()
    {
        return $this->attributes['is_online'] ? 'Online' : 'Offline';
    }
    public function userInfo(): HasOne
    {
        return $this->hasOne(UserInfos::class);
    }

    public function offer(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
    public function prepositions(): HasMany
    {
        return $this->hasMany(Preposition::class);
    }


    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }
    public function followings()
    {
        return $this->hasMany(Following::class, 'followed_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
