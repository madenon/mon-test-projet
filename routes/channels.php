<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Transaction;
use App\Models\Preposition;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('transactions.{transactionId}', function ($user, int $transactionId) {
    $isMe = $user->id === Transaction::find($transactionId)->proposition->user->id ;
    $isCounter = $user->id === Transaction::find($transactionId)->proposition->offer->user->id ;
    
    return $isMe || $isCounter;
});

Broadcast::channel('propositions.{propositionId}', function (User $user, int $propositionId) {
    $isMe = $user->id === Preposition::find($propositionId)->user->id ;
    $isCounter = $user->id === Preposition::find($propositionId)->offer->user->id ;
    
    return $isMe || $isCounter;
});