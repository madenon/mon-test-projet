<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Preposition;
use App\Models\ChMessage;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;




class PropositionController extends Controller
{
    public function index(){
        $prepositions = Preposition::with('user', 'offer')
        ->select('prepositions.*', 'users.first_name as user_name', 'offers.title as offer_name')
        ->join('users', 'users.id', '=', 'prepositions.user_id')
        ->join('offers', 'offers.id', '=', 'prepositions.offer_id')
        ->where('users.id',auth()->id())
        ->get();

    return view('preposition.index', compact('prepositions'));
    }
    public function create(Request $request,$offerid,$userid)
    { 
        //create request and don't authorize autotroc
        $offer = Offer::find($offerid);
        $request->merge([
            'other_id'=>  $offer->user_id,
            'user_id'=>  auth()->id(),
        ]);
        $request->validate([
            'other_id' =>'required|integer',
            'user_id'=>   'required|integer|different:other_id',
        ],[
            'user_id.different' => 'Vous ne pouvez pas faire de trocs avec vous meme, veuillez svp choisir l\'offre d\'une personne tierce'
        ]);

        return view('preposition.create', compact('offer','userid'));
    }

    public function store(Request $request)
    {
        $request->merge(['status' => 'En cours']);

        $request->validate([
            'name' => 'required',
            'offer_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'price' => 'nullable|numeric',
            
        ]);

       
  // Process the image upload
  if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
    $image->storeAs('public/proposition_pictures', $imageName);
    // You can save $imageName to the database if needed
}

// Create the Preposition
$preposition = Preposition::create($request->except('image'));

$offer=Offer::find($request->offer_id);
$message = ChMessage::create([
    'id' => Str::uuid()->toString(),
    'from_id' => $request->user_id,
    'to_id' =>$offer->user->id,
    'body' => $request->negotiation,
    'preposition_id' => $preposition->id,
]);


// You can associate the image with the preposition if needed
if (isset($imageName)) {
    $preposition->update(['images' => json_encode($imageName)]);
}
   //Create a message for proposition 
   

        // You can add a success message or redirect to a different page
        return redirect()->route('propositions.index')->with('success', 'Proposition created successfully');
    }
    public function updateStatus(Request $request)
{
    $propositionId = $request->input('propositionId');
    $newStatus = $request->input('newStatus');
    $proposition=Preposition::find($propositionId);
    if($proposition!=null){
    if ($newStatus === 'Acceptée') {
        // Create a transaction
        $transaction = Transaction::create([
            'proposition_id' => $proposition->id,
            'status' => 'En cours', 
            'amount' => $proposition->price?$proposition->price:'0', 
            'name' => $proposition->name, 
            'date' => now()
        ]);

        //TODO:Notify propsition maker so he can rating the order
        
    }
   
    $proposition->status = $newStatus;
    $proposition->save();

    return response()->json(['success' => true]);}
    return response()->json(['id'=>$propositionId]);
}

public function destroy($prepositionId)
{
    // Find the Preposition model
    $preposition = Preposition::find($prepositionId);

    if (!$preposition) {
        // Handle case where the preposition is not found
        return response()->json(['error' => 'Preposition not found'], 404);
    }

    // Delete associated records in ch_messages
$preposition->chMessages()->delete();
$preposition->transactions()->delete();

// Now delete the preposition
$preposition->delete();

    // Optionally, you can return a success response
    return response()->json(['success' => true]);
}
public function update(Request $request, $prepositionId)
    {
        // Validate the request data 
        $request->validate([
            // Add validation rules for your form fields
        ]);

        // Find the Preposition model
        $preposition = Preposition::find($prepositionId);

        if (!$preposition) {
            // Handle case where the preposition is not found
            return response()->json(['error' => 'Preposition not found'], 404);
        }

        // Update the preposition attributes based on the form data
        $preposition->update($request->all());

        
        return response()->json(['success' => true]);
    }

    public function chat($prepositionId){
        $preposition = Preposition::find($prepositionId);
        $id=$preposition->offer->user->id;
        return redirect()->route('user',$id);
    }
}
