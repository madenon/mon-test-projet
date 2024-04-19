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
       
        $offer->update(['default_image_id' => $request->default_image_id]);
    
        return redirect(route('myaccount.offers'))->with(['success', 'Annonce mis à jours', ['offerId']]);
    }

    public function updateOffer(Request $request, $offerId)
    {    
        (new OfferController)->update($request, $offerId);
        return redirect(route('myaccount.offers'))->with(['success', 'Annonce mis à jours', ['offerId']]);
    }
    public function showFavorite(){
        $user = auth()->user();
        $favoriteOffers = $user?->favorites()->paginate(10); // Adjust the number per page as needed

    return view('myaccount.favorites', compact('favoriteOffers'));
    }

}
