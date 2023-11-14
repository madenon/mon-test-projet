<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Preposition;


class PropositionController extends Controller
{
    public function index(){
        $prepositions = Preposition::with('user', 'offer')
        ->select('prepositions.*', 'users.first_name as user_name', 'offers.title as offer_name')
        ->join('users', 'users.id', '=', 'prepositions.user_id')
        ->join('offers', 'offers.id', '=', 'prepositions.offer_id')
        ->get();

    return view('preposition.index', compact('prepositions'));
    }
    public function create($offerid,$userid)
    { $offer = Offer::find($offerid);
        return view('preposition.create', compact('offer','userid'));
    }

    public function store(Request $request)
    {
        $request->merge(['status' => 'pending']);

        $request->validate([
            'name' => 'required',
            'offer_id' => 'required',
            'status' => 'required|in:validated,pending,accepted',
        ]);

        Preposition::create($request->all());

        // You can add a success message or redirect to a different page
        return redirect()->route('propositions.index')->with('success', 'Proposition created successfully');
    }
    public function updateStatus(Request $request)
{
    $propositionId = $request->input('propositionId');
    $newStatus = $request->input('newStatus');

    $proposition = Preposition::find($propositionId);
    if($proposition!=null){
    $proposition->status = $newStatus;
    $proposition->save();

    return response()->json(['success' => true]);}
    return response()->json(['id'=>$propositionId]);
}
}
