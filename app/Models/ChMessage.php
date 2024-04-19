<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Chatify\Traits\UUID;


class ChMessage extends Model
{
    use UUID;

    protected $fillable = ['id', 'from_id', 'to_id', 'body', 'preposition_id'];


    public function preposition(): BelongsTo
    {
        return $this->belongsTo(Preposition::class);
    }
    public function parent(): HasOne
    {
        return $this->hasOne(Reply::class,'reply_id');
    }
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class,'message_id');
    }


}
