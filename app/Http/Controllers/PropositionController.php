<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Preposition;
use App\Models\User;
use App\Models\Transaction;




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
            'status' => 'required|in:refused,pending,accepted',
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

// You can associate the image with the preposition if needed
if (isset($imageName)) {
    $preposition->update(['images' => $imageName]);
}
   

        // You can add a success message or redirect to a different page
        return redirect()->route('propositions.index')->with('success', 'Proposition created successfully');
    }
    public function updateStatus(Request $request)
{
    $propositionId = $request->input('propositionId');
    $newStatus = $request->input('newStatus');
    $proposition=Preposition::find($propositionId);
    if($proposition!=null){
    if ($newStatus === 'accepted') {
        // Create a transaction
        $transaction = Transaction::create([
            'proposition_id' => $proposition->id,
            'status' => 'completed', 
            'amount' => $proposition->price?$proposition->price:'0', 
            'name' => $proposition->name, 
            'date' => now()
        ]);

        // Associate the transaction with the proposition
       
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

    // Delete the preposition
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

    
}
