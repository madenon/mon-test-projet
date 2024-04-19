<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index($type)
    {
        $ty = Type::first('id')->get();
        $offers = Offer::where('type_id', $ty);

        return view('type', compact('offers', 'type'));
    }

}
