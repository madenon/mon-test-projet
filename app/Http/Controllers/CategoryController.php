<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Type;
use Illuminate\Http\Request;

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

        return view('category', compact('category', 'offers', 'type'));
    }
}
