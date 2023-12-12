<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Region;
use App\Models\Offer;
use App\Models\Type;
use App\Models\Preposition;
use App\Models\User;

class AppliedFilters extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $departments = Department::all();
        $types=Type::all();
        $query = request()->input('query');
        $category = request()->input('category'); // Retrieve the selected category
        $department = request()->input('department');
        $region = request()->input('region');
        $type = request()->input('type');
        $minPrice = request()->input('min_price');
        $maxPrice = request()->input('max_price');
        $sortOrder = request()->input('sort_by', 'latest'); // Default sorting order
        $online=request()->input('online');

       

        
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

        $offersCount=$queryBuilder->count();


        
            
    $filters = [];
    if($type)array_push($filters,[
        "type"=>"type",
        "name"=> Type::find($type)->name
    ]);
    
    foreach($departments as $department){
        $dep=request()->input($department->name);
        if($dep)array_push($filters,[
            "type"=>"department",
            "name"=> $department->name,
            "icon"=>'fa-map-marker-alt',
        ]);
    }
    $parentcategories = Category::whereNull('parent_id')->get();
    $subcategories = Category::whereNull('type_id')->get();
    foreach($subcategories as $subcategory){
        $sub=request()->input($subcategory->name);
        if($sub)array_push($filters,[
            "type"=>"subcategory",
            "name"=> $subcategory->name,
            "icon"=>$subcategory->parent->icon,
        ]);
        
    }
    $priceRange=($minPrice?$minPrice:0)." EUR~".($maxPrice?$maxPrice:4000)." EUR";
    if(($maxPrice || $minPrice) && ($minPrice!=0 || $maxPrice!=4000))array_push($filters,[
        "type"=>"price",
        "name"=> $priceRange,
        "icon"=>'fa-money-bill',
    ]);
    if($online)array_push($filters,[
        "type"=>"online",
        "name"=> $online=="online"?"En ligne":"Hors ligne",
        "icon"=>'fa-user',
    ]);




        return view('components.applied-filters', compact('filters','departments','types', 
            'offersCount'));
    }
}
