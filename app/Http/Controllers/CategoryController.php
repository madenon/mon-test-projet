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
}
