<?php

namespace App\Http\Controllers;

use App\Enums\Condition;
use App\Enums\ExperienceLevel;
use App\Models\Category;
use App\Models\Ratings;
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

class MyAccountController extends Controller
{
    public function index(){
        $user = Auth::user();
        $userInfo = UserInfos::where('user_id', $user->id)->first();
        $offer = Offer::where('user_id', $user->id)->first();

        $offerPrepostion = Preposition::where('offer_id', $offer->id)->count();
        $finishedOffers = Offer::whereNotNull('deleted_at')->count();
        $offersInProgress = Offer::whereNull('deleted_at')->count();

        return view('myaccount.index', compact('user','userInfo', 'offerPrepostion', 'finishedOffers', 'offersInProgress'));
    }

    public function rateUser(Request $request, $ratedUserId)
    {
        $request->validate([
            'stars' => 'required|integer|between:1,5',
        ]);

        $ratedByUserId = auth()->user()->id;

        if ($ratedUserId != $ratedByUserId) {
            $existingRating = Ratings::where('user_id', $ratedUserId)
                ->where('rated_by_user_id', $ratedByUserId)
                ->first();

            if ($existingRating) {
                $existingRating->update([
                    'stars' => $request->input('stars'),
                ]);
            } else {
                Ratings::create([
                    'user_id' => $ratedUserId,
                    'rated_by_user_id' => $ratedByUserId,
                    'stars' => $request->input('stars'),
                ]);
            }

            return redirect()->back()->with('success', 'Rating submitted successfully!');
        } else {
            return redirect()->back()->with('error', 'You cannot rate yourself!');
        }
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

    public function updateOffer(Request $request, $offerId)
    {
        $user = Auth::user();
        $offer = Offer::find($offerId)->with('user_id', $user->id);

        $request->validate([
            'type' => ['required_if:old_type, $offer->type_id'],
            'experience' => ['nullable'],
            'condition' => ['nullable'],
            'category' => ['required_if:old_category, $offer->category_id'],
            'subcategory' => ['required_if:old_subcategory, $offer->subcategory_id'],
            'region' => ['required_if:old_region, $offer->region_id'],
            'department' => ['required_if:old_department, $offer->department_id'],
            'title' => ['required', 'string', 'between:10,100'],
            'description' => ['string'],
            'default_image' => ['nullable','image','mimes:jpeg,png','max:4096'], 
            'additional_images.*' => ['nullable','image','mimes:jpeg,png','max:4096'], 
        ], [
            'title' => 'Le nom de l\'annonce doit contenir entre 10 et 100 caractères.',
            'default_image.max' => 'Vous ne pouvez pas télécharger plus de 4mb.',
            'default_image.mimes' => 'Les fichiers téléchargés doivent être au format jpg ou png.',
        ]);

        $offer->title = $request->title;
        $offer->type_id = $request->type_id;
        $offer->subcategory_id = $request->category_id;
        $offer->category_id = $request->category_id;
        $offer->department_id = $request->department_id;
        $offer->region_id = $request->region_id;
        $offer->description = $request->description;
        $offer->price = $request->price;
        $offer->perimeter = $request->perimeter;
        $offer->experience = $request->experience;
        $offer->condition = $request->condition;

        if ($request->hasFile('default_image')) {
            
            $ext = $request->file('default_image')->getClientOriginalExtension();
            $imageDefault = uniqid() . '.' . $ext;
            $request->file('default_image')->storeAs('public/offer_pictures', $imageDefault);
            $offer->offer_default_photo = $imageDefault;
        }

        if ($request->hasFile('additional_images')) {
            
            if ($offer->additionalImages) {
                foreach ($offer->additionalImages as $image) {
                    Storage::delete('public/offer_pictures/' . $image->offer_photo);
                    $image->delete();
                }
            }
 
            foreach ($request->file('additional_images') as $file) {
                $ext = $file->getClientOriginalExtension();
                $name = uniqid() . '.' . $ext;
                $file->storeAs('public/offer_pictures', $name);
                OfferImages::create([
                    'offer_photo' => $name,
                    'offer_id' => $offer->id,
                ]);
            }
        }

        $offer->update();
        
        return redirect(route('myaccount.offers'))->with(['success', 'Annonce mis à jours', ['offerId']]);
    }

}
