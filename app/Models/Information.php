<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = 'informations'; // Add this line

    protected $fillable = [
        'facebook',
        'instagram',
        'youtube',
        'email',
        'phone',
        'contrat',
    ];
}
