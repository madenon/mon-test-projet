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
        $regions = Region::all();
        $types=Type::all();
        $query =request()->input('query');
        $category =request()->input('category'); // Retrieve the selected category
        $department =request()->input('department');
        $region =request()->input('region');
        $type =request()->input('type');
        $minPrice =request()->input('min_price');
        $maxPrice =request()->input('max_price');
        $sortOrder =request()->input('sort_by', 'latest'); // Default sorting order
        $online=request()->input('online');

       
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
        if($maxPrice || $minPrice)array_push($filters,[
            "type"=>"price",
            "name"=> $priceRange,
            "icon"=>'fa-money-bill',
        ]);


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
        $isOnline=true;
        if($online) {
            $completedOffersId=Preposition::where('status','!=','pending')->pluck('offer_id')->toArray();
            if($online=="online")
            $queryBuilder->whereNotIn('id',$completedOffersId);
            else
            $queryBuilder->whereIn('id',$completedOffersId);
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
        $offersCount=$queryBuilder->count();
            



        return view('components.applied-filters', compact('filters','departments','types', 
            'offersCount','regions'));
    }
}
