<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'discount_percentage', 'products_included', 'sponsor_id'];

    // Define the relationship with the Sponsor model
    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
}
