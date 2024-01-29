<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'disputer_id',
        'transaction_id',
        'preposition_id',
        'description',
    ];
    
    public function disputer(){
        return  $this->belongsTo(User::class,'disputer_id');
    }
    public function preposition(){
        return $this->belongsTo(Preposition::class);
    }
    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

}
