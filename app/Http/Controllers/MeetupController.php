<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meetup;
use App\Models\Preposition;
use App\Models\User;
use App\Notifications\NewMeetUp;

class MeetupController extends Controller
{
    public function scheduleMeetup(Request $request)
    {
        // Validate form data
        $request->validate([
            'prepositionId' => 'required|exists:prepositions,id',
            'meetupDate' => 'required|date',
            'meetupTime' => 'required',
            'meetupDescription' => 'required',
            'userId' => 'required|integer',
        ]);

        // Get form data
        $prepositionId = $request->input('prepositionId');
        $meetupDate = $request->input('meetupDate');
        $meetupTime = $request->input('meetupTime');
        $meetupDescription = $request->input('meetupDescription');
        $userId = $request->input('userId');

        // Save the meetup schedule
        $meetup = Meetup::updateOrCreate([
            'preposition_id' => $prepositionId,
            ],[
            'preposition_id' => $prepositionId,
            'status' => 'pending',
            'date' => $meetupDate,
            'time' => $meetupTime,
            'description' => $meetupDescription,
            'user_id' => $userId,
        ]);
        $meetup->save();
        $proposition = Preposition::where('id', $prepositionId)->firstOrFail();
        $propositionuser=$proposition->user;
        $offeruser=$proposition->offer->user;
                $meetuser=User::find($userId);
                if ($propositionuser->id !== $meetuser->id) {
                    $propositionuser->notify(new NewMeetUp($proposition,$propositionuser));
                } elseif ($offeruser->id !== $meetuser->id) {
                    $offeruser->notify(new NewMeetUp($proposition, $offeruser));
                } 
        

        return response()->json(['success' => true]);
    }
    public function updateMeetStatus($meetId)
{
    // Get the meet instance by ID
    $meet = Meetup::find($meetId);

    $meet->status = request('status');
    $meet->save();
    // Optionally, you can return a response or redirect
    return response()->json(['message' => 'Meet status updated successfully']);
}

}
