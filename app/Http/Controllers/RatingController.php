<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Preposition;
use App\Models\User;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use Illuminate\Http\Request;


class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

        $user = User::find($id);
        if(!$user)redirect()->route(myaccount.index);
        $ratings=$user->ratings;
        $ratingsCount=$ratings->count();
        $ratingsAvg=$ratings->avg('stars');
        $ratingsGroupCount=$ratings->groupBy('stars');
        foreach($ratingsGroupCount as $k=>$v){
            $ratingsGroupCount[$k]=100*$v->count()/$ratingsCount;
        }
        for($k=1;$k<=5;$k++)
            if(!isset($ratingsGroupCount[$k]))
            $ratingsGroupCount[$k]=0;

        return view('myaccount.ratings',compact(
            'ratings',
            'ratingsAvg',
            'ratingsCount',
            'ratingsGroupCount',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRatingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }

    public function rate($prepositionId,$raterId, $ratedId, $stars, $feedback)
    {
        
        
        if ($raterId == $ratedId) return null;

        $rating = Rating::updateOrCreate([
            'user_id' => $ratedId,
            'rated_by_user_id' => $raterId,
        ], [
            'user_id' => $ratedId,
            'rated_by_user_id' => $raterId,
            'stars' => $stars,
            'feedback' => $feedback,
            'preposition_id' => $prepositionId,
        ]);
        
        return $rating; 

    }
    
    public function rateTaker(Request $request)
    {
        $request->validate([
            'propositionId' => 'required|integer',
            'stars' => 'integer|between:0,5',
            'feedback' => 'string',
        ]);
        
        $preposition=Preposition::find($request->propositionId);
        $makerId=$preposition->offer->user_id;
        $takerId=$preposition->user_id;
        if($request->stars)
        return response($this->rate($request->propositionId,$makerId,$takerId,$request->stars,$request->feedback), 200);
    else return response(null, 200);
    
}
public function rateMaker(Request $request)
    {
        $request->validate([
            'propositionId' => 'required|integer',
            'stars' => 'integer|between:0,5',
            'feedback' => 'string',
        ]);
        
        $preposition=Preposition::find($request->propositionId);
        $makerId=$preposition->offer->user_id;
        $takerId=$preposition->user_id;
        if($request->stars)
        return response($this->rate($request->propositionId,$takerId,$makerId,$request->stars,$request->feedback), 200);
        else return response(null, 200);

    }

    
}
