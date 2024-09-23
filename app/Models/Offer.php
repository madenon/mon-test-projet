<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Enums\ExperienceLevel;
use Orchid\Metrics\Chartable;


class Offer extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Chartable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'exchange_state',
        'experience',
        'date',
        'condition',
        'offer_default_photo',
        'price',
        'slug',
        'perimeter',
        'user_id',
        'type_id',
        'category_id',
        'subcategory_id',
        'region_id',
        'department_id',
        'buy_authorized',
        'send_authorized',
        'active_offer',
        'expiration_date',
        'active_animation',
        'default_image_id',
        'last_top'
    ];

    protected $casts = [
        'level' => ExperienceLevel::class,
        'buy_authorized'=>'boolean',
        'send_authorized'=>'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites', 'offer_id', 'user_id')->withTimestamps();
}
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Category::class,'subcategory_id');
    }
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function preposition(): HasMany
    {
        return $this->hasMany(Preposition::class);
    }

    public function offerImages(): HasMany
    {
        return $this->hasMany(OfferImages::class);
    }
    public function defaultImage(): BelongsTo
    {
        return $this->belongsTo(OfferImages::class,'default_image_id');
    }
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
