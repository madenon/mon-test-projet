<?php

namespace App\Http\Controllers;

use App\Enums\Condition;
use App\Enums\ExperienceLevel;
use App\Models\Category;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Preposition;
use App\Models\Region;
use App\Models\Type;
use App\Models\UserInfos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\OfferImages;


class AccountController extends Controller
{
    public function index($id){
        $user = User::find($id);
        if(!$user)redirect()->route('myaccount.index');
        $userInfo = UserInfos::where('user_id', $user->id)->first();
        $offer = Offer::where('user_id', $user->id)->first();

        $offerPrepostion = $offer?Preposition::where('offer_id', $offer->id)->count():0;
        $finishedOffers = Offer::where('user_id', $user->id)
        ->whereNotNull('deleted_at')->count();
        $offersInProgress = Offer::where('user_id', $user->id)
        ->whereNull('deleted_at')->count();

        $ratings=$user->ratings;
        $ratingsCount=$ratings->count();
        $ratingsAvg=$ratings->avg('stars');
        $followersCount=$user->followings->count();

        return view('myaccount.index', compact(
            'user',
            'userInfo', 
            'offerPrepostion', 
            'finishedOffers', 
            'offersInProgress',
            'ratingsAvg',
            'ratingsCount',
            'followersCount',
        ));
    }
}
