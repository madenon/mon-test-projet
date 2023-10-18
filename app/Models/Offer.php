<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Enums\ExperienceLevel;


class Offer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;



    protected $fillable = [
        'name',
        'slug',
        'description',
        'exchange_state',
        'experience',
        'offer_default_photo',
        'price',
        'slug',
        'perimeter',
        'user_id',
        'type_id',
        'category_id',
        'region_id',
        'department_id',
    ];


    protected $casts = [
        'level' => ExperienceLevel::class,
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

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
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
}
