<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Type;
use App\Models\Preposition;
use App\Models\User;

class AlloffersController extends Controller
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
        $online=$request->input('online');
 
        $queryBuilder = Offer::with('preposition')
        ->orderBy('created_at', 'DESC')
        ->where('active_offer', 1);
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
        if($online) {
            $onlineUsers=User::where('is_online',true)->pluck('id')->toArray();
            if($online=="online")
            $queryBuilder->whereIn('user_id',$onlineUsers);
            else
            $queryBuilder->whereNotIn('user_id',$onlineUsers);
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
        $categoryName = Category::where('id', $category)->value('name');
        return view('alloffers.index', compact('offers','departments','types','categoryName'));
    }
}
