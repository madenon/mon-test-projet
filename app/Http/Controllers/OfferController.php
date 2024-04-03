<?php

namespace App\Http\Controllers;

use App\Enums\Condition;
use App\Models\Category;
use App\Models\Department;
use App\Models\Offer;
use App\Models\OfferImages;
use App\Models\Region;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Enums\ExperienceLevel;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Notifications\NewReport;



class OfferController extends Controller
{
    public function index(Request $request)
    {
        // Get the list of departments
        $departments = Department::all();
        $types=Type::all();
        $query = $request->input('query');
        $category = $request->input('category'); // Retrieve the selected category
        $department = $request->input('department');
        $region = $request->input('region');
        $type = $request->input('type');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sortOrder = $request->input('sort_by', 'latest'); // Default sorting order

    
        $queryBuilder = Offer::with('preposition.meetup')
        ->orderBy('created_at', 'DESC')
        ->where('active_offer', 1)
        ->where('launch_date',null)
        ->where('user_id',auth()->id());  // to get my offers   
        if ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%');
        }
    
        if ($category) {
            $queryBuilder->where('category_id', $category); // Filter by category ID
        }
        if ($department) {
            $queryBuilder->where('department_id', $department); // Filter by category ID
        }
        if ($type) {
            $queryBuilder->where('type_id', $type); // Filter by category ID
        }
        if ($region) {
            $queryBuilder->where('region_id', $region); // Filter by category ID
        }
        if ($minPrice) {
            $queryBuilder->where('price', '>=', $minPrice);
        }
    
        if ($maxPrice) {
            $queryBuilder->where('price', '<=', $maxPrice);
        }
    
        // Add sorting condition
        if ($sortOrder === 'latest') {
            $queryBuilder->orderBy('created_at', 'DESC');
        } elseif ($sortOrder === 'oldest') {
            $queryBuilder->orderBy('created_at', 'ASC');
        } elseif ($sortOrder === 'price_low') {
            $queryBuilder->orderBy('price', 'ASC');
        } elseif ($sortOrder === 'price_high') {
            $queryBuilder->orderBy('price', 'DESC');
        }
        $offers = $queryBuilder->paginate(10);
        $user = User::find(auth()->id());
        $categoryName = Category::where('id', $category)->value('name');

        $ratings=$offer->ratings;
        $ratingsCount=$ratings->count();
        $ratingsAvg=$ratings->avg('stars');

        // check if user is connected
        if( $user!=null){
            $onlineStatus = $user->is_online;
            return view('offer.index', compact('offers', 'onlineStatus','departments','types','categoryName'));
        }
        
    }

    public function create()
    {
        $categories = Category::whereNull("parent_id")->get();
        $subcategories = Category::where("parent_id", '!=', NULL)->get();
        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all()->load('categories');
        $experienceLevels = ExperienceLevel::toArray();
        $conditions = Condition::toArray();

        return view('offer.create',compact(
            'types',
            'categories',
            'subcategories',
            'regions',
            'departments',
            'experienceLevels',
            'conditions',
        ));
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'type' => ['required'],
            'experience' => ['nullable'],
            'condition' => ['nullable'],
            'category' => ['required'],
            'subcategory' => ['required'],
            'region' => ['required'],
            'department' => ['required'],
            'title' => ['required', 'string', 'between:2,100'],
            'description' => ['required','string'],
            'default_image' => ['required','image','mimes:jpeg,png','max:4096'],
            'additional_images.*' => ['nullable','image','mimes:jpeg,png','max:4096'],
            'additional_images' => ['max:10'],
        'valueInput' => 'nullable|numeric',
        ], [
            'title' => 'Le nom de l\'annonce doit contenir entre 2 et 100 caractères.',
            'default_image.max' => 'Vous ne pouvez pas télécharger plus de 4mb.',
            'default_image.mimes' => 'Les fichiers téléchargés doivent être au format jpg ou png.',
            'additional_images.max' => 'Le nombre maximal d\'images autorisé est :max.',
        ]);

        $slug = Str::slug($request->title, '-');
        $id = DB::transaction(function () use ($request, $slug) {
            $user = Auth::user();
            $category = Category::find($request->category);
            $subcategory = Category::find($request->subcategory);
            $region = Region::find($request->region);
            $department = Department::find($request->department);
            $type = Type::find($request->type);
            $extention = explode("/", $request->default_image->getMimeType())[1];
            $imageDefault = uniqid() . '.' . $extention;
            $experience = $request->has('experience')? $request->experience : null;
            $condition  = $request->has('condition')? $request->condition : null;
            // Retrieve values from dynamic inputs
            $dynamicInputs = $request->input('dynamicInputs');
            // Serialize the values before saving to the database
            $serializedInputs = json_encode($dynamicInputs);
            // Calculate expiration date based on countdown option and region timezone
            if($request->expiration_date){
                $carbonDate = Carbon::parse($request->expiration_date);
                // Format the date as needed for database storage
                $expirationDate = $carbonDate->format('Y-m-d H:i:s');
            } else {$expirationDate =null;}
                $launchOption = $request->input('launchOption');
                $launchTime = $request->input('launchTime');
                $launchDate = null;
                if ($launchOption === 'differe') {
                    if ($launchTime === '6h') {
                        $launchDate = now()->addHours(6);
                    } elseif ($launchTime === '12h') {
                        $launchDate = now()->addHours(12);
                    }
                    elseif ($launchTime === '1j') {
                        $launchDate = now()->addDay();
                    }    
                    elseif ($launchTime === '3j') {
                        $launchDate = now()->addDays(3);
                    }   
                    elseif ($launchTime === '5j') {
                        $launchDate = now()->addDays(5);
                    } 
                    elseif ($launchTime === '7j') {
                        $launchDate = now()->addDays(7);
                    }
                    elseif ($launchTime === '30j') {
                        $launchDate = now()->addDays(30);
                    } 
            }

            $id = DB::table('offers')
                ->insertGetId(
                    [
                        'title' => $request->title,
                        'description' => $request->description,
                        'offer_default_photo' => $imageDefault,
                        'slug' => $slug,
                        'user_id' => $user->id,
                        'type_id' => $type->id,
                        'subcategory_id' => $subcategory->id,
                        'department_id' => $department->id,
                        'experience' => $experience,
                       'condition' => $condition,
                       'expiration_date'=>$expirationDate,
                       'launch_date'=>$launchDate,
                       'price'=>$request->valueInput ? $request->valueInput : 0 ,
                       'buy_authorized' => $request->has('sellCheckbox') ? 1 : 0,
                       'send_authorized' => $request->has('sendCheckbox') ? 1 : 0,
                       'specify_proposition'=>$request->has('exchangeCheckbox')? 1 : 0 ,
                       'dynamic_inputs' => $serializedInputs,
                       'created_at' => \Carbon\Carbon::now()
                    ]
                );
          
            Storage::putFileAs('public/offer_pictures', $request->default_image, $imageDefault);
            $defaultImage = OfferImages::create([
                'offer_photo' => $imageDefault,
                'offer_id' => $id,
            ]);
            $offer = Offer::find($id);
            $offer->default_image_id = $defaultImage->id;
            $offer->save();

            if($request->has('additional_images')){
                foreach ($request->additional_images as $key => $value) {
                    $name = uniqid() . '.' . $extention;
                    Storage::putFileAs('public/offer_pictures', $value, $name);
                    OfferImages::create([
                        'offer_photo' => $name,
                        'offer_id' => $id
                    ]);
                }
            }
            return $id;
        });

        return redirect()->route('offer.offer', ['offerId'=>$id, 'slug'=>$slug])->with('success', 'produit ajouté');

    }
    public function storeOfferImage(Request $request)
    {
        $request->validate([
            'additional_images.*' => ['nullable','image','mimes:jpeg,png','max:4096']
        ], [
            'default_image.max' => 'Vous ne pouvez pas télécharger plus de 4mb.',
            'default_image.mimes' => 'Les fichiers téléchargés doivent être au format jpg ou png.',
        ]);

            if($request->has('additional_images')){
                $offerId = $request->input('offer_id');
                foreach ($request->additional_images as $key => $value) {
                    $ext = $value->getClientOriginalExtension();  // Get the file extension
                    $name = uniqid() . '.' . $ext;
                    Storage::putFileAs('public/offer_pictures', $value, $name);
                    OfferImages::create([
                        'offer_photo' => $name,
                        'offer_id' => $offerId
                    ]);
                }
            }
     

            return response()->json(['success' => 'Image deleted successfully.']);

    }

    protected function show($offerid, $slug)
    {
        $offer = Offer::find($offerid);
        $subcategoryIds=$offer->subcategory->parent->children->pluck('id')->toArray();
        $similaroffers = Offer::whereIn('subcategory_id', $subcategoryIds)->where('id', '!=', $offer->id)->Paginate(3);
        if(!$similaroffers){
            $similaroffers = [];
        }
        $type = Type::where('id', $offer->type_id)->first();
        $images = OfferImages::where('offer_id',$offer->id)->get();
        $category = Category::where('id', $offer->subcategory->parent_id)->first();
        $subcategory = Category::where('id', $offer->subcategory_id)->first();
        

        return view(
            'offer.offer',
            compact([
                'offer',
                'type',
                'category',
                'similaroffers',
                'subcategory',
                'images'
            ]));
    }

    public function destroyOffer(Offer $offer){
        $offer->delete();

        return redirect()->route('myaccount.offers')->with('success','Annoce supprimer avec succès');
    }

    public function activate(Offer $offer)
    {
        $offer->update(['active_offer' => true]);
        
        return redirect()->route('myaccount.offers')->with('success', 'Offer activated successfully');
    }

    public function deactivate(Offer $offer)
    {
        $offer->update(['active_offer' => false]);

        return redirect()->route('myaccount.offers')->with('success', 'Offer deactivated successfully');
    }

    public function search(Offer $offer)
    {
        $search = $_GET['get'];
        $offer = Offer::where('name', 'like', '%'. $search .'%')->get();

        return view('offer.search', compact('offer'));
    }

    public function chat($offerId){
        $offer = Offer::find($offerId);
        $id=$offer->user->id;
        return redirect()->route('user',$id);
    }
    public function report(Request $request,$offerId){
        $report=Report::create([
            'title' => $request->title,
            'reporter_id' => Auth::user()->id, // Replace with the actual reporter user ID
            'offer_id' => $offerId, // Replace with the actual offer ID
            'description' => $request->description,
        
        ]);
        foreach(User::all() as $user){
            if($user->is_admin)
            $user->notify(new NewReport($report));             
        }
        return $report;
    }
    // favoris 
    // Example of adding an offer to favorites
public function addToFavorites(Offer $offer)
{
    auth()->user()->favorites()->attach($offer->id);

    return redirect()->back()->with('success', 'Offer added to favorites.');
}

// Example of removing an offer from favorites
public function removeFromFavorites(Offer $offer)
{
    auth()->user()->favorites()->detach($offer->id);

    return redirect()->back()->with('success', 'Offer removed from favorites.');
}
public function deleteImage(Request $request)
{
    $imageId = $request->input('imageId');

    // Find the image by ID
    $image = OfferImages::find($imageId);

    if (!$image) {
        return response()->json(['error' => 'Image not found.'], 404);
    }

    // Get the file path from the image record
    $filePath = 'public/offer_pictures/' . $image->offer_photo;

    // Delete the image record from the database
    $image->delete();

    // Delete the actual image file from storage
    
        Storage::delete($filePath);
    

    return response()->json(['success' => 'Image deleted successfully.']);
}
public function updateActiveAnimation(Request $request) {
    // Retrieve offer ID from the request
    $offerId = $request->input('offerId');

    // Assuming you have an "offers" table and an "active_animation" column
    $offer = Offer::find($offerId);

    if ($offer) {
        // Toggle the value of the active_animation property
        $offer->update(['active_animation' => !$offer->active_animation]);

        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false]);
    }
}

}
