<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Preposition;
use App\Models\ChMessage;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Dispute;
use Illuminate\Support\Str;
use App\Notifications\NewPreposition;
use App\Notifications\NewTransaction;
use App\Notifications\NewDispute;
use App\Notifications\PropositionResult;
use App\Notifications\PropositionConfirmation;
use Illuminate\Support\Facades\Log;
use App\Events\PropositionStatusUpdated;
use Illuminate\Support\Facades\DB;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Auth;
use App\Models\PropositionImages;
use App\Models\OfferImages;
use GrahamCampbell\ResultType\Success;

class PropositionController extends Controller
{
    public function index(Request $request)
    {
        $query = Preposition::with('user', 'offer')
            ->select('prepositions.*', 'users.first_name as user_name', 'offers.title as offer_name')
            ->join('users', 'users.id', '=', 'prepositions.user_id')
            ->join('offers', 'offers.id', '=', 'prepositions.offer_id')
            ->join('users as userOffers', 'offers.user_id', '=', 'userOffers.id')
            ->where(function ($query) {
                $query->where('users.id', auth()->id())
                    ->orWhere('userOffers.id', auth()->id());
            });
    
        // Apply additional filters before pagination
        if (!($request->has('in_progress')) || $request->input('in_progress') == 1) {
            $query->where(function ($query) {
                $query->where('prepositions.status', 'En cours')
                    ->orWhere(function ($query) {
                        $query->where('status', 'Acceptée')
                            ->where('validation', '!=', 'confirmedTransaction');
                    });
            });
        }
    
        if ($status = $request->input('status')) {
            if ($status == 'pending') $status = 'En cours';
            if ($status == 'accepted') $status = 'Acceptée';
            if ($status == 'rejected') $status = 'Rejetée';
            $query->where('status', $status);
        }
    
        if ($startDate = $request->input('start_date')) {
            $query->whereDate('prepositions.created_at', '>=', $startDate);
        }
    
        if ($endDate = $request->input('end_date')) {
            $query->whereDate('prepositions.created_at', '<=', $endDate);
        }
    
        if ($numberProp = $request->input('number_prop')) {
            $query->where('prepositions.uuid', 'like', '%' . $numberProp . '%');
        }
    
        if ($nameOffer = $request->input('name_offer')) {
            $query->where('offers.title', 'like', '%' . $nameOffer . '%');
        }
    
        // Paginate the results
        $prepositions = $query->orderBy('created_at', 'desc')->paginate(10);
    
        return view('preposition.index', compact('prepositions'));
    }
    
    
    public function create(Request $request,$offerid,$userid)
    { 
        //create request and don't authorize autotroc
        $offer = Offer::find($offerid);
        $user = Auth::user();
        $offers = $user->offer;
        $images = OfferImages::where('offer_id',$offer->id)->get();
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

        return view('preposition.create', compact('offer','userid','offers','images'));
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
            'image' => ['nullable', 'image', 'mimes:jpeg,png', 'max:4096'],
            'additional_images.*' => ['nullable', 'image', 'mimes:jpeg,png', 'max:4096'],
            'additional_images' => ['max:8'],
            'existing_images' => ['max:10'],
            
        ], [
            'image.max' => 'Vous ne pouvez pas télécharger plus de 4 Mo.',
            'image.mimes' => 'Les fichiers téléchargés doivent être au format jpg ou png.',
            'additional_images.max' => 'Le nombre maximal d\'images autorisé est :max.',
            'existing_images.max' => 'Le nombre maximal d\'images autorisé est :max.',
        ]);

       
  // Process the image upload
  if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
    $storePath = 'public/proposition_pictures/' . $imageName;
     ImageHelper::addWatermarkAndSave($image,$storePath);
   // $image->storeAs('public/proposition_pictures', $imageName);
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
        $receiver=User::find($preposition->offer->user_id);
        
        $receiver->notify(new NewPreposition($preposition));
        
        

        // You can associate the image with the preposition if needed
        if (isset($imageName)) {
            $preposition->update(['images' => json_encode($imageName)]);
        }
        
        if($request->has('additional_images')){
            foreach ($request->additional_images as $key => $value) {
                $imageName = uniqid() . '.' . $value->getClientOriginalExtension();
                $storePath = 'public/proposition_pictures/' . $imageName;
             ImageHelper::addWatermarkAndSave($value,$storePath);
                PropositionImages::create([
                    'proposition_photo' => $imageName,
                    'proposition_id' => $preposition->id,
                    'photo_path_type' => 'proposition'
                ]);
            }
        }
        
             // Handle existing image URLs or IDs
    if ($request->has('existing_images')) {
        foreach ($request->input('existing_images') as $existingImage) {
            // Use existing image path or ID to link the image to the proposition
            PropositionImages::create([
                'proposition_photo' => $existingImage,
                'proposition_id' => $preposition->id,
                'photo_path_type' => 'offer'
            ]);
        }
    }
              return redirect()->route('propositions.index')->with('success', 'Proposition created successfully');
    }
    public function updateStatus(Request $request)
    {
        $propositionId = $request->input('propositionId');
        $newStatus = $request->input('newStatus');
        $proposition=Preposition::findOrFail($propositionId);
        $taker=User::find($proposition->user_id);
        $proposition->status = $newStatus;
        $proposition->validation = 'validated';
        if ($newStatus === 'Acceptée') {                
            $offer = $proposition->offer;
            
            foreach( $offer->preposition as $prep){
                if($prep->id != $proposition->id){
                    $prep->status = "Rejetée";
                    $prep->validation = 'none';                   
                    $prep->user->notify(new PropositionResult($prep,$prep->user));   
                    $prep->save();
                }
            }
            
            $taker->notify(new PropositionConfirmation($proposition,$taker));   
        }else{
            $taker->notify(new PropositionResult($proposition,$taker));   
        }
        
        PropositionStatusUpdated::dispatch($proposition);
        
        $proposition->save();
        
        return response()->json(['success' => true]);
    }
    public function confirm(Request $request)
    {
        $propositionId = $request->input('propositionId');
        $confirm = $request->input('confirm');
        $proposition=Preposition::findOrFail($propositionId);
        $taker=User::find($proposition->offer->user->id);
        $proposition->validation = 'confirmed';
        if ( $confirm === 'Yes') {
            // Create a transaction
            $transaction = Transaction::updateOrCreate([
                'offer_id' => $proposition->offer->id,
            ],[
                'offer_id' => $proposition->offer->id,
                'proposition_id' => $proposition->id,
                'offeror_status' => 'En cours', 
                'applicant_status' => 'En cours', 
                'amount' => $proposition->price?$proposition->price:'0', 
                'name' => $proposition->name, 
                'date' => now()
            ]);
            
            $taker->notify(new PropositionResult($proposition,$taker));   
            
            $offer = $proposition->offer;
            
        }else{
            $proposition->status = "Rejetée";
            $taker->notify(new PropositionResult($proposition,$taker));   
        }
        PropositionStatusUpdated::dispatch($proposition);
        
        $proposition->save();

        return response()->json(['success' => true]);
        
    }


    public function destroy($prepositionId)
    {
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Delete associated records in ch_messages
           // DB::table('ch_messages')->where('preposition_id', $prepositionId)->delete();
           DB::table('ch_messages')->where('preposition_id', $prepositionId)->delete();
           DB::table('meetups')->where('preposition_id', $prepositionId)->delete();
           
           DB::table('transactions')->where('proposition_id', $prepositionId)->delete();
    
            // Delete the preposition
            DB::table('prepositions')->where('id', $prepositionId)->delete();
    
            // Commit the transaction
            DB::commit();
    
            return response()->json(['message' => 'Preposition and associated records deleted successfully']);
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollback();
            
            return response()->json(['error' => $e], 500);
        }
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
    
    public function dispute(Request $request,$prepositionId){
        $dispute=Dispute::create([
            'title' => $request->title,
            'disputer_id' => auth()->id(), 
            'preposition_id' => $prepositionId, 
            'description' => $request->description,
        ]);
        foreach(User::all() as $user){
            if($user->is_admin)
            $user->notify(new NewDispute($dispute));             
        }
        $preposition = Preposition::find($prepositionId);
        $preposition->appealed=true;
        $preposition->save();
        return $dispute;
    }
    public function chat_proposition_sender($prepositionId){
        $preposition = Preposition::find($prepositionId);
        $id=$preposition->user_id;
        return redirect()->route('user',$id);
    }
    
    public function show($id)
    {
        $preposition = Preposition::findOrFail($id);
         return view('preposition.show', compact(
             'preposition'
         ));    
    }
}
