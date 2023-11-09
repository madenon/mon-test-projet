<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Region;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index($type, $category)
    {
        $cat = Category::first('id')->get();
        $offers = Type::where('type_id', $cat);

        return view('category', compact('offers', 'type', 'category'));
    }   

    public function showSimilarOffers($offer, $category_id, $category_name)
    {
        $offer = Offer::where('id', $offer)->get();
        $offers = Offer::where('category_id', $category_id)->paginate(10);
        $category = Category::where('id' ,$category_id)->get();
        $type = Type::where('id', 'type_id')->get();

        return view('showSimilarOffers', compact('category', 'offers', 'type'));
    }

    public function showOffersByCategory($slug)
    {
        $type = Type::where('name', $slug)->first();
        $category = Category::where('slug', $slug)->first();
        $region = Region::where('name', $slug)->first();
        $offres = [];
        $title = "";

        if(!empty($category)) {
            $title = $category;
            $offers = Offer::where('active_offer', true)
            ->where('category_id', $category->id)
            ->paginate(10);
        }else if(!empty($region)) {
            $title = $region;
            $offers = Offer::where('active_offer', true)
            ->where('region_id', $region->id)
            ->paginate(10);
        }else if(!empty($type)) {
            $title = $type;
            $offers = Offer::where('active_offer', true)
            ->where('type_id', $type->id)
            ->paginate(10);
        }
        
            
        return view('showOffersByCategory', compact('offers', 'title','slug'));
    }

}
