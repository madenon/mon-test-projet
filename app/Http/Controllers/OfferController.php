<?php

namespace App\Http\Controllers;

use App\Enums\Condition;
use App\Models\Category;
use App\Models\Department;
use App\Models\Offer;
use App\Models\OfferImages;
use App\Models\Region;
use App\Models\Type;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Enums\ExperienceLevel;
use Illuminate\Support\Str;
use App\Rules\ImageFileRule;

class OfferController extends Controller
{


    public function index()
    {
        $offers = Offer::orderBy('created_at', 'DESC')->paginate(10);
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
        // dd($request->default_image);

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



        DB::transaction(function () use ($request) {
            $user = Auth::user();
            $category = Category::find($request->category);
            $subcategory = Category::find($request->subcategory);
            $region = Region::find($request->region);
            $department = Department::find($request->department);
            $type = Type::find($request->type);
            $slug = Str::slug($request->title, '-');
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
            // OfferImages::create([
            //     'offer_photo' => $imageDefault,
            //     'offer_id' => $id
            // ]);
            Storage::putFileAs('public/offer_pictures', $request->default_image, $imageDefault);


            if($request->has('additional_images')){
                foreach ($request->additional_images as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }
                    $name = uniqid() . '.' . $extention;
                    Storage::putFileAs('public/offer_pictures', $value, $name);
                    OfferImages::create([
                        'offer_photo' => $name,
                        'offer_id' => $id
                    ]);
                }
            }

        });

        return redirect()->route('offer.index')->with('success', 'produit ajouté');

    }

    protected function uploadOfferImage(UploadedFile $file): string
    {
        if ($file->isValid()) {
            $path = $file->store('public/offer_pictures');
            return Storage::url($path);
        }

        return '';
    }



    protected function show($offerid, $slug)
    {
        $offer = Offer::find($offerid);

        //dd($offer);

        //dd($offer->id);

        $similaroffers = Offer::where('category_id', $offer->category_id)->where('id', '!=', $offer->id)->get();
        if(!$similaroffers){
            $similaroffers = [];
        }

        //dd($similaroffers);
        //$slug = Offer::where('slug', $offer->slug)->get('slug');

        $type = Type::where('id', $offer->type_id)->first();
        $images = OfferImages::where('offer_id',$offer->id)->get();

        //dd($images);
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


}
