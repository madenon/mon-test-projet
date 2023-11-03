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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Enums\ExperienceLevel;
use Illuminate\Support\Str;


class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::orderBy('created_at', 'DESC')->where('active_offer', 1)->paginate(10);
        $user = User::find(1);
        $onlineStatus = $user->is_online;

        return view('offer.index', compact('offers', 'onlineStatus'));
    }

    public function create()
    {
        $categories = Category::whereNull("parent_id")->get();
        $subcategories = Category::where("parent_id", '!=', NULL)->get();
        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all();
        $experienceLevels = ExperienceLevel::toArray();
        $conditions = Condition::toArray();

        return view('offer.create')->with([
            'types' => $types,
            'departments' => $departments,
            'regions' => $regions,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'experienceLevels' => $experienceLevels,
            'conditions' => $conditions
        ]);
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
            'title' => ['required', 'string', 'between:10,100'],
            'description' => ['string'],
            'default_image' => ['nullable','image','mimes:jpeg,png','max:4096'],
            'additional_images.*' => ['nullable','image','mimes:jpeg,png','max:4096'],
        ], [
            'title' => 'Le nom de l\'annonce doit contenir entre 10 et 100 caractères.',
            'default_image.max' => 'Vous ne pouvez pas télécharger plus de 4mb.',
            'default_image.mimes' => 'Les fichiers téléchargés doivent être au format jpg ou png.',
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

            $id = DB::table('offers')
                ->insertGetId(
                    [
                        'title' => $request->title,
                        'description' => $request->description,
                        'offer_default_photo' => $imageDefault,
                        'slug' => $slug,
                        'user_id' => $user->id,
                        'type_id' => $type->id,
                        'category_id' => $category->id,
                        'subcategory_id' => $subcategory->id,
                        'region_id' => $region->id,
                        'department_id' => $department->id,
                        'experience' => $experience,
                        'condition' => $condition,
                        'created_at' => \Carbon\Carbon::now()
                    ]
                );
          
            Storage::putFileAs('public/offer_pictures', $request->default_image, $imageDefault);

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

        return redirect()->route('offer.offer', ['offer'=>$id, 'slug'=>$slug])->with('success', 'produit ajouté');

    }

    protected function show($offerid, $slug)
    {
        $offer = Offer::find($offerid);
        $similaroffers = Offer::where('category_id', $offer->category_id)->where('id', '!=', $offer->id)->Paginate(3);
        if(!$similaroffers){
            $similaroffers = [];
        }
        $type = Type::where('id', $offer->type_id)->first();
        $images = OfferImages::where('offer_id',$offer->id)->get();
        $category = Category::where('id', $offer->category_id)->first();
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

}
