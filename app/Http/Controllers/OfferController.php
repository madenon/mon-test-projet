<?php

namespace App\Http\Controllers;

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

        $category = Category::where("parent_id", NULL)->get();
        $sous_Category = Category::where("parent_id", '!=', NULL)->get();
        $region = Region::all();
        $department = Department::all();
        $type = Type::all();
        $experienceLevels = ExperienceLevel::toArray();

        return view('offer.create')->with([
            'type' => $type,
            'department' => $department,
            'region' => $region,
            'category' => $category,
            'sous_category' => $sous_Category,
            'experienceLevels' => $experienceLevels
        ]);
    }


    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'between:10,100'],
            'description' => ['string'],
            'offer_photo' => ['max:1024', 'max:12', new ImageFileRule],
        ], [
            'name' => 'Le nom de l\'annonce doit contenir entre 10 et 100 caractères.',
            'offer_photo.max' => 'Vous ne pouvez pas télécharger plus de 12 images.',
            'offer_photo.image_file' => 'Les fichiers téléchargés doivent être au format jpg ou png.',
        ]);



        DB::transaction(function () use ($request) {
            $user = Auth::user();
            $category = Category::find($request->category_id);
            $region = Region::find($request->region_id);
            $department = Department::find($request->department_id);
            $type = Type::find($request->type_id);
            $slug = Str::slug($request->name, '-');
            $extention = explode("/", $request->offer_photo[0]->getMimeType())[1];
            $imageDefault = uniqid() . '.' . $extention;
            $id = DB::table('offers')
                ->insertGetId(
                    [
                        'name' => $request->name,
                        'description' => $request->description,
                        'offer_default_photo' => $imageDefault,
                        'price' => $request->price,
                        'perimeter' => $request->perimeter,
                        'slug' => $slug,
                        'user_id' => $user->id,
                        'type_id' => $type->id,
                        'category_id' => $category->id,
                        'region_id' => $region->id,
                        'department_id' => $department->id,
                    ]
                );
            OfferImages::create([
                'offer_photo' => $imageDefault,
                'offer_id' => $id
            ]);
            Storage::putFileAs('public/offer_pictures', $request->offer_photo[0], $imageDefault);
            foreach ($request->offer_photo as $key => $value) {
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


    protected function show(Offer $offer, $slug)
    {

        $similarOffers = Offer::where('category_id', $offer->category_id)->where('id', '!=', $offer->id)->get();

        $slug = Offer::where('slug', $offer->slug)->get('slug');

        $type = Type::where('id', $offer->type_id)->pluck('name')->first();
        $images=OfferImages::where('offer_id',$offer->id)->get();
        $category = Category::where('id', $offer->category_id)->pluck('name')->first();
        $sousCategorys = Category::where('parent_id', $offer->category_id)->get()[0];
        return view('offer.offer', compact(['offer', 'slug', 'type', 'category', 'similarOffers','sousCategorys','images']));
    }


}
