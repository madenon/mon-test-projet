<?php

namespace App\Http\Controllers;

use App\Enums\Condition;
use App\Enums\ExperienceLevel;
use App\Models\Category;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Region;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\OfferImages;

class MyAccountController extends Controller
{
    public function index(){

        $user = Auth::user();

        return view('myaccount.index', $user);
    }

    public function showOffer(){

        $user = Auth::user();
        $offers = Offer::where('user_id', $user->id)
                   ->orderBy('created_at', 'DESC')
                   ->get();
        
        return view('myaccount.offers', compact('offers'));
    }

    public function editOffer($offerId){
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

    public function updateOffer(Request $request, $offerId){

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
            // Delete the old image file if necessary
            // Save the new image and update the offer
            $ext = $request->file('default_image')->getClientOriginalExtension();
            $imageDefault = uniqid() . '.' . $ext;
            $request->file('default_image')->storeAs('public/offer_pictures', $imageDefault);
            $offer->offer_default_photo = $imageDefault;
        }

        if ($request->hasFile('additional_images')) {
            // Delete the old additional images if necessary
            if ($offer->additionalImages) {
                foreach ($offer->additionalImages as $image) {
                    Storage::delete('public/offer_pictures/' . $image->offer_photo);
                    $image->delete();
                }
            }

            // Save the new additional images
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
