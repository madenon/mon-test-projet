<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['message_id', 'reply_id'];

    public function message(): BelongsTo
    {
        return $this->belongsTo(ChMessage::class,'message_id');
    }
    public function reply(): BelongsTo
    {
        return $this->belongsTo(ChMessage::class,'reply_id');
    }

}
