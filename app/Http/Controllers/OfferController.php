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

class OfferController extends Controller
{


    public function index(){

        $offers = Offer::orderBy('created_at', 'DESC')->paginate(10);
        $user = User::find(1);

        $onlineStatus = $user->is_online;

        return view('offer.index', compact('offers' , 'onlineStatus'));
    }   

    public function create(){

        $category = Category::all();
        $region = Region::all();
        $department = Department::all();
        $type = Type::all();


        return view('offer.create')->with([
            'type' => $type,
            'department' => $department,
            'region' => $region,
            'category' => $category,
        ]);
    }


    public function store(Request $request): RedirectResponse
    {
            

            $request->validate([
                'name' => ['required', 'string', 'between:10,100'],
                'description' => ['string'],
            ], [
                'name' => 'Le nom de l\'annonce doit contenir entre 10 et 100 caractères.',
            ]);
    
            DB::transaction(function () use ($request) {

                $user = Auth::user();
                $category = Category::find($request->category_id);
                $region = Region::find($request->region_id);
                $department = Department::find($request->department_id);
                $type = Type::find($request->type_id);
                

                $storePicture = $this->uploadOfferImage($request->file('offer_default_photo'));

                Offer::create([
                    'name' => $request->name,
                    'description' => $request-> description,
                    'offer_default_photo' => $storePicture,
                    'price' => $request-> price,
                    'perimeter' => $request -> perimeter,
                    'user_id' => $user->id,
                    'type_id' => $type->id,
                    'category_id'=>$category->id,
                    'region_id'=>$region->id,
                    'department_id'=>$department->id,
                ]);

                

                
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

    protected function show(Offer $offer){

        return view('offer.offer', compact('offer'));

    }


    
    

    
}
