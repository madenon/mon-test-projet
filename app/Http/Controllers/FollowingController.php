<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Following;



class FollowingController extends Controller
{
    public function follow($followedId)
    {
        
        $followerId=Auth::id();
        if ($followerId == $followedId) return null;

        $following = Following::updateOrCreate([
            'followed_id' => $followedId,
            'follower_id' => $followerId,
        ], [
            'followed_id' => $followedId,
            'follower_id' => $followerId,
        ]);
        
        return redirect()->back();
    }

    public function unfollow($followedId)
    {
        
        $followerId=Auth::id();
        if ($followerId == $followedId) return null;

        Following::where('followed_id', $followedId)
            ->where('follower_id', $followerId)
            ->delete();
        
        return redirect()->back();
    }

}
