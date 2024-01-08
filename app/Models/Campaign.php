<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
// Inside the Campaign model
protected $fillable = ['name', 'link', 'start_date', 'end_date', 'discount_percentage', 'products_included', 'sponsor_id', 'banner', 'page', 'position','timezone'];

    // Define the relationship with the Sponsor model
    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
}
