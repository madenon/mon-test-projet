<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function offer()
    {
        return $this->hasMany(Offer::class);
    }

    public function department()
    {
        return $this->hasMany(Department::class);
    }
}
