<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function offer(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'type_category', 'type_id', 'category_id');
    }
    
}
