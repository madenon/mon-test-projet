<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;
use App\Models\Rating;
use App\Models\Following;
use App\Models\Transactions;
use App\Notifications\VerifyEmailNotification;
use App\Notifications\PasswordReset;


class User extends Authenticatable  implements MustVerifyEmail
{
        use HasApiTokens, HasFactory, Notifiable;
/**
 * Send the password reset notification.
 *
 * @param  string  $token
 * @return void
 */
public function sendPasswordResetNotification($token)
{
    $this->notify(new PasswordReset($token));
}
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'permissions',
        'last_name',
        'first_name',
        'profile_photo_path',
        'is_online',
        'avatar',
        'role',
        'statusPro'
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
    
    public function userInfo(): HasOne
    {
        return $this->hasOne(UserInfos::class);
    }
 public function chMessages()
    {
        return $this->hasMany(ChMessage::class, 'to_id');
    }
    public function offer(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
    public function prepositions(): HasMany
    {
        return $this->hasMany(Preposition::class);
    }
    public function transactions(): HasManyThrough
    {
        return $this->hasManyThrough(Transaction::class, Preposition::class, 'user_id','proposition_id');
    }
    public function favorites()
    {
        return $this->belongsToMany(Offer::class, 'favorites')->withTimestamps();
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }
    public function followings()
    {
        return $this->hasMany(Following::class, 'followed_id');
    }
    
    public function badges()
    {
        return $this->belongsToMany(Badge::class);
    }
        
     /**
     * Enter your own logic (e.g. if ($this->id === 1) to
     *   enable this user to be able to add/edit blog posts
     *
     * @return bool - true = they can edit / manage blog posts,
     *        false = they have no access to the blog admin panel
     */
    public function canManageBinshopsBlogPosts()
    {
        // Enter the logic needed for your app.
        // Maybe you can just hardcode in a user id that you
        //   know is always an admin ID?

        if ($this->role == "admin"){

           // return true so this user CAN edit/post/delete
           // blog posts (and post any HTML/JS)

           return true;
        }

        // otherwise return false, so they have no access
        // to the admin panel (but can still view posts)

        return false;
    }
}
