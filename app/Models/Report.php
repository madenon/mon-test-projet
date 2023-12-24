<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'reporter_id',
        'offer_id',
        'description',
    ];

    public function reporter(){
        return  $this->belongsTo(User::class,'reporter_id');
    }
    public function offer(){
        return $this->belongsTo(Offer::class);
    }
}
