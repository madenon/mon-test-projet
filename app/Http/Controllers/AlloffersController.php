<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Type;
use App\Models\Preposition;
use App\Models\User;
use Illuminate\Support\Facades\DB;


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
        $deps=request()->input('departments');
        $subs=request()->input('subcategories');

        
 
        $queryBuilder = Offer::with('preposition')
        ->where('active_offer', 1)
        ->where('launch_date', null);

        if ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%');
        }
        
        if ($category) {
            $cat = Category::find($category);
            if($cat){
                $subcategoryIds = $cat->children->pluck('id')->toArray();
                $queryBuilder->whereIn('subcategory_id', $subcategoryIds);
            }
        }
        if ($department) {
            $queryBuilder->where('department_id', $department); // Filter by category ID
        }
        if ($type) {
            $queryBuilder->where('type_id', $type); // Filter by category ID
        }
       
            if ($request->has('region') && $request->region!='' ) {
                $regionId = $request->input('region');
                
                $queryBuilder->whereHas('department.region', function ($query) use ($regionId) {
                    $query->where('id', $regionId);
                });    }
        
        if ($minPrice) {
            $queryBuilder->where('price', '>=', $minPrice);
        }
        
        if ($maxPrice) {
            $queryBuilder->where('price', '<=', $maxPrice);
        }
        if($request->has('online')) {
            $onlineUsers=DB::table('users')->select('id')->where('is_online', 1);
            // $request->session()->flash('online', $online);
            if($online){
                $queryBuilder->whereIn('user_id',$onlineUsers);
            }
            else{
                $queryBuilder->whereNotIn('user_id',$onlineUsers);
            }
        }
        if($deps){
            $queryBuilder->whereIn('department_id', $deps);
        }
        if($subs){
            $queryBuilder->whereIn('subcategory_id', $subs);   
        }
        
         // Add sorting condition
         if ($sortOrder === 'latest') {
            $queryBuilder->orderBy('created_at', 'DESC');
        } else if ($sortOrder === 'oldest') {
            $queryBuilder->orderBy('created_at', 'ASC');
        } else if ($sortOrder === 'price_desc') {
            $queryBuilder->orderBy('price', 'DESC');
        } else if ($sortOrder === 'price_asc') {
            $queryBuilder->orderBy('price', 'ASC');
        }
        
        $queryBuilder->where(function ($query) {
            $query->where('last_top', '>', \Carbon\Carbon::now()->addDays(2))
            ->orderBy('last_top', 'DESC')
            ->orWhere('last_top', '<=', \Carbon\Carbon::now()->addDays(2));
        });
        
        $offersCount=$queryBuilder->count();
        $offers = $queryBuilder->paginate(10)->appends([
            'query' => $query,
            'category' => $category,
            'department' => $department,
            'region' => $region,
            'type' => $type,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'sort_by' => $sortOrder,
            'online' => $online,
            'departments' => $deps,
            'subcategories' => $subs,
        ]);
        
        $categoryName = Category::where('id', $category)->value('name');
        $banners=Campaign::all();

        return view('alloffers.index', compact('offers','banners','departments','types','categoryName','offersCount'));
    
    }
    public function indexx(Request $request,$id_user)
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
        $deps=request()->input('departments');
        $subs=request()->input('subcategories');

        
 
        $queryBuilder = Offer::with('preposition')
        ->where('active_offer', 1)
        ->where('launch_date', null)
        ->where('user_id',$id_user);

        if ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%');
        }
        
        if ($category) {
            $cat = Category::find($category);
            if($cat){
                $subcategoryIds = $cat->children->pluck('id')->toArray();
                $queryBuilder->whereIn('subcategory_id', $subcategoryIds);
            }
        }
        if ($department) {
            $queryBuilder->where('department_id', $department); // Filter by category ID
        }
        if ($type) {
            $queryBuilder->where('type_id', $type); // Filter by category ID
        }
       
            if ($request->has('region') && $request->region!='' ) {
                $regionId = $request->input('region');
                
                $queryBuilder->whereHas('department.region', function ($query) use ($regionId) {
                    $query->where('id', $regionId);
                });    }
        
        if ($minPrice) {
            $queryBuilder->where('price', '>=', $minPrice);
        }
        
        if ($maxPrice) {
            $queryBuilder->where('price', '<=', $maxPrice);
        }
        if($request->has('online')) {
            $onlineUsers=DB::table('users')->select('id')->where('is_online', 1);
            // $request->session()->flash('online', $online);
            if($online){
                $queryBuilder->whereIn('user_id',$onlineUsers);
            }
            else{
                $queryBuilder->whereNotIn('user_id',$onlineUsers);
            }
        }
        if($deps){
            $queryBuilder->whereIn('department_id', $deps);
        }
        if($subs){
            $queryBuilder->whereIn('subcategory_id', $subs);   
        }
        
         // Add sorting condition
         if ($sortOrder === 'latest') {
            $queryBuilder->orderBy('created_at', 'DESC');
        } else if ($sortOrder === 'oldest') {
            $queryBuilder->orderBy('created_at', 'ASC');
        } else if ($sortOrder === 'price_desc') {
            $queryBuilder->orderBy('price', 'DESC');
        } else if ($sortOrder === 'price_asc') {
            $queryBuilder->orderBy('price', 'ASC');
        }
        
        $queryBuilder->where(function ($query) {
            $query->where('last_top', '>', \Carbon\Carbon::now()->addDays(2))
            ->orderBy('last_top', 'DESC')
            ->orWhere('last_top', '<=', \Carbon\Carbon::now()->addDays(2));
        });
        
        $offersCount=$queryBuilder->count();
        $offers = $queryBuilder->paginate(10)->appends([
            'query' => $query,
            'category' => $category,
            'department' => $department,
            'region' => $region,
            'type' => $type,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'sort_by' => $sortOrder,
            'online' => $online,
            'departments' => $deps,
            'subcategories' => $subs,
        ]);
        
        $categoryName = Category::where('id', $category)->value('name');
        $banners=Campaign::all();

        return view('alloffers.index', compact('offers','banners','departments','types','categoryName','offersCount'));
    
    }
}
