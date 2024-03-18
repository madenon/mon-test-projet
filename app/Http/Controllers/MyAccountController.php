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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\OfferImages;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


class MyAccountController extends Controller
{
    public function index($id=null){
        $user = Auth::user();
        $offers = $user->offer;
        $mesPropositions=$user->prepositions;
        $totalTransactions = 0;
        $totalTransactionsFromOffers = 0;
        foreach ($offers as $offer) {
            // Count transactions from propositions of the offer
            $totalTransactionsFromOffers += $offer->preposition->flatMap->transactions
                ->where('offeror_status', 'Réussi')
                ->where('applicant_status', 'Réussi')
                ->count();
        }

        // Count transactions from propositions
        $totalTransactionsFromMesPropositions = $mesPropositions->flatMap->transactions
        ->where('offeror_status', 'Réussi')
        ->where('applicant_status', 'Réussi')
            ->count();

        // Total transactions
        $totalTransactions = $totalTransactionsFromOffers + $totalTransactionsFromMesPropositions;

        $userInfo = UserInfos::where('user_id', $user->id)->first();
        $offerPrepostion = $mesPropositions->count();
        $finishedOffers =$totalTransactions ;
         $offersInProgress = $user->offer()->whereNull('deleted_at')->get()->count();

        $medalBronzeSilver=30;
        $medalSilverGold=60;

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
            'medalBronzeSilver',
            'medalSilverGold',
            'ratingsAvg',
            'ratingsCount',
            'followersCount',
        ));
    }
    public function accountPro($id=null){
        $user = Auth::user();
        $offers = $user->offer;
        $mesPropositions=$user->prepositions;
        $totalTransactions = 0;
        $totalTransactionsFromOffers = 0;
        foreach ($offers as $offer) {
            // Count transactions from propositions of the offer
            $totalTransactionsFromOffers += $offer->preposition->flatMap->transactions
                ->where('offeror_status', 'Réussi')
                ->where('applicant_status', 'Réussi')
                ->count();
        }

        // Count transactions from propositions
        $totalTransactionsFromMesPropositions = $mesPropositions->flatMap->transactions
        ->where('offeror_status', 'Réussi')
        ->where('applicant_status', 'Réussi')
            ->count();

        // Total transactions
        $totalTransactions = $totalTransactionsFromOffers + $totalTransactionsFromMesPropositions;

        $userInfo = UserInfos::where('user_id', $user->id)->first();
        $offerPrepostion = $mesPropositions->count();
        $finishedOffers =$totalTransactions ;
         $offersInProgress = $user->offer()->whereNull('deleted_at')->get()->count();

        $medalBronzeSilver=30;
        $medalSilverGold=60;

        $ratings=$user->ratings;
        $ratingsCount=$ratings->count();
        $ratingsAvg=$ratings->avg('stars');
        $followersCount=$user->followings->count();

        return view('myaccount.pro', compact(
            'user',
            'userInfo', 
            'offerPrepostion', 
            'finishedOffers', 
            'offersInProgress',
            'medalBronzeSilver',
            'medalSilverGold',
            'ratingsAvg',
            'ratingsCount',
            'followersCount',
        ));
    }


    public function showOffer()
    {
        $user = Auth::user();
        $offers = Offer::where('user_id', $user->id)
                   ->orderBy('created_at', 'DESC')
                   ->paginate(10);
        
        return view('myaccount.offers', compact('offers'));
    }

    public function editOffer($offerId)
    {    
        $this->authorize('modify-offer', Offer::find($offerId));
        $user = Auth::user();
        $categories = Category::whereNull("parent_id")->get();
        $subcategories = Category::where("parent_id", '!=', NULL)->get();
        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all();
        $offer = Offer::find($offerId);
        $experienceLevels = ExperienceLevel::toArray();
        $conditions = Condition::toArray();
        $images = OfferImages::where('offer_id',$offerId)->get();

        return view('myaccount.editOffer')->with([
            'user' => $user,
            'types' => $types,
            'departments' => $departments,
            'regions' => $regions,
            'categories' => $categories,
            'offer' => $offer,
            'subcategories' => $subcategories,
            'experienceLevels' => $experienceLevels,
            'conditions' => $conditions,
            'images'=> $images
        ]);
        
    }
    public function updateOfferImages(Request $request, $offerId)
    {    
        $user = Auth::user();
        $offer = Offer::with('category') 
        ->where('id', $offerId)
        ->where('user_id', $user->id)
        ->first();
       
        if ($request->has('default_image')) {
            $offer->update(['offer_default_photo' => $request->default_image ]);} 
       
                return redirect(route('myaccount.offers'))->with(['success', 'Annonce mis à jours', ['offerId']]);
    }

    public function updateOffer(Request $request, $offerId)
    {    
        $user = Auth::user();
        $offer = Offer::with('category') 
        ->where('id', $offerId)
        ->where('user_id', $user->id)
        ->first();
       
    
        $request->validate([
            'type' => ['required_if:old_type, $offer->type_id'],
            'experience' => ['nullable'],
            'condition' => ['nullable'],
            'category' => ['required_if:old_category, $offer->subcategory->parent_id'],
            'subcategory' => ['required_if:old_subcategory, $offer->subcategory_id'],
            'region' => ['required_if:old_region, $offer->department->region_id'],
            'department' => ['required_if:old_department, $offer->department_id'],
            'title' => ['required', 'string', 'between:5,100'],
            'description' => ['string'],
            'default_image' => ['nullable','image','mimes:jpeg,png','max:4096'], 
            'additional_images.*' => ['nullable','image','mimes:jpeg,png','max:4096'], 
        ], [
            'title' => 'Le nom de l\'annonce doit contenir entre 5 et 100 caractères.',
            'default_image.max' => 'Vous ne pouvez pas télécharger plus de 4mb.',
            'default_image.mimes' => 'Les fichiers téléchargés doivent être au format jpg ou png.',
        ]);

        $offer->title = $request->title;
        $offer->type_id = $request->type_id;
        $offer->subcategory_id=$request->subcategory_id;

        
        $offer->department_id = $request->department_id;
        $offer->department->region_id = $request->region_id;
        $offer->description = $request->description;
        $offer->price = $request->price;
        $offer->perimeter = $request->perimeter;
        if($request->type_id==2){
        $offer->condition = $request->condition;}
        else {        $offer->condition = null;}
        if($request->type_id==7){
            $offer->experience = $request->experience;}
            else {        $offer->experience = null;}


        if ($request->hasFile('default_image')) {
            
            $ext = $request->file('default_image')->getClientOriginalExtension();
            $imageDefault = uniqid() . '.' . $ext;
            $request->file('default_image')->storeAs('public/offer_pictures', $imageDefault);

        }

        if ($request->hasFile('additional_images')) {
            $offerImages=OfferImages::where('offer_id',$offerId)->get();
           
                foreach ($offerImages as $image) {
                    Storage::delete('public/offer_pictures/' . $image->offer_photo);
                    $image->delete();
                }
            
 
            foreach ($request->file('additional_images') as $file) {
                $ext = $file->getClientOriginalExtension();
                $name = uniqid() . '.' . $ext;
                $file->storeAs('public/offer_pictures', $name);
                OfferImages::create([
                    'offer_photo' => $name,
                    'offer_id' => $offerId,
                ]);
            }
        }
        if ($request->hasFile('default_image')) {
        $offer->update(array_merge(
            $request->except('_token','category_id','region_id', '_method', 'CONDITION','default_image','additional_images'),
            ['offer_default_photo' => $imageDefault]
        ));} else{
            // Save the changes
DB::beginTransaction();

try {
    $offer->save();
   

    // Commit the transaction
    DB::commit();
} catch (\Exception $e) {
    // Rollback the transaction if an exception occurs
    DB::rollback();
    throw $e;
}
        }
       
                return redirect(route('myaccount.offers'))->with(['success', 'Annonce mis à jours', ['offerId']]);
    }
    public function showFavorite(){
        $user = auth()->user();
        $favoriteOffers = $user?->favorites()->paginate(10); // Adjust the number per page as needed

    return view('myaccount.favorites', compact('favoriteOffers'));
    }

}
