<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Region;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $categories = Category::all();
        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all();
        $offer = Offer::find($offerId);

        return view('myaccount.editOffer')->with([
            'user' => $user,
            'types' => $types,
            'departments' => $departments,
            'regions' => $regions,
            'categories' => $categories,
            'offer' => $offer,
        ]);
        
    }
}
