<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meetup;
use App\Models\Preposition;


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
        ]);

        // Get form data
        $prepositionId = $request->input('prepositionId');
        $meetupDate = $request->input('meetupDate');
        $meetupTime = $request->input('meetupTime');
        $meetupDescription = $request->input('meetupDescription');

        // Save the meetup schedule
        $meetup = new Meetup([
            'preposition_id' => $prepositionId,
            'date' => $meetupDate,
            'time' => $meetupTime,
            'description' => $meetupDescription,
        ]);
        $meetup->save();

        // Optionally, update the status of the preposition
        $preposition = Preposition::findOrFail($prepositionId);
        $preposition->save();

        return response()->json(['success' => true]);
    }
    public function updateMeetStatus($meetId)
{
    // Get the meet instance by ID
    $meet = Meetup::find($meetId);

    // Assuming 'status' is a column in your 'meets' table
    $meet->status = request('status');
    $meet->save();

    // Optionally, you can return a response or redirect
    return response()->json(['message' => 'Meet status updated successfully']);
}

}
