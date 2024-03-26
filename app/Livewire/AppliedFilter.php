<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Region;
use App\Models\Offer;
use App\Models\Type;
use App\Models\Preposition;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AppliedFilter extends Component
{
    public $filters = [];
    public function render(Request $request)
    {
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
        $deps=$request->input('departments');
        $subs=$request->input('subcategories');
        

        
        $queryBuilder = Offer::with('preposition')
        ->orderBy('created_at', 'DESC')
        ->where('active_offer', 1);
        if ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%');
            // $request->session()->flash('query', $query);
            
        }
        
        if ($category) {
            $subcategoryIds = Category::find($category)->children->pluck('id')->toArray();
            $queryBuilder->whereIn('subcategory_id', $subcategoryIds); // Filter by category ID
            // $request->session()->flash('category', $category);
        }
        if ($department) {
            $queryBuilder->where('department_id', $department); // Filter by category ID
            // $request->session()->flash('department', $department);
        }
        if ($type) {
            $queryBuilder->where('type_id', $type); // Filter by category ID
            // $request->session()->flash('type', $type);
        }
        if ($request->has('region') && $request->region!='' ) {
            $regionId = $request->input('region');
            // $request->session()->flash('region', $region);
            
            $queryBuilder->whereHas('department.region', function ($query) use ($regionId) {
                $query->where('id', $regionId);
            });   
        }
        if ($minPrice) {
            $queryBuilder->where('price', '>=', $minPrice);
            // $request->session()->flash('min_price', $minPrice);
        }
        
        if ($maxPrice) {
            $queryBuilder->where('price', '<=', $maxPrice);
            // $request->session()->flash('max_price', $maxPrice);
        }
        if($request->has('online')) {
            $onlineUsers=DB::table('users')->select('id')->where('is_online', 1);
            // $request->session()->flash('online', $online);
            if($online){
                $queryBuilder->whereIn('user_id',$onlineUsers);
                $queryBuilder->whereNotIn('user_id',$onlineUsers);
            }
            else{
                $queryBuilder->whereNotIn('user_id',$onlineUsers);
            }
        }
        if($deps){
            $queryBuilder->whereIn('department_id', $deps);
            foreach($request->input('departments') as $dep){
                // $request->session()->flash('departments.'.$dep, Department::find($dep)->name);
            }
        }
        if($subs){
            $queryBuilder->whereIn('subcategory_id', $subs);   
            foreach($request->input('subcategories') as $subs){
                // $request->session()->flash('subcategories.'.$subs, Category::find($subs)->name);
            }
        }


        $offersCount=$queryBuilder->count();


        
            
    if($type)array_push($this->filters,[
        "type"=>"type",
        "key"=> Type::find($type)->name,
        "name"=> Type::find($type)->name
    ]);
    if($request->input('departments'))
    foreach($request->input('departments') as $dep){
        array_push($this->filters,[
            "type"=>"department",
            "name"=> Department::find($dep)->name,
            "key"=> Department::find($dep)->name,
            "icon"=>'fa-map-marker-alt',
        ]);
    }
    $parentcategories = Category::whereNull('parent_id')->get();
    $subcategories = Category::whereNull('type_id')->get();
    if($request->input('subcategories'))
    foreach($request->input('subcategories') as $sub){
        array_push($this->filters,[
            "type"=>"subcategory",
            "name"=> Category::find($sub)->name,
            "key" => $sub,
            "icon"=> Category::find($sub)->parent->icon,
        ]);  
    }
    if ($category){
        $category=Category::find($category);
        array_push($this->filters,[
            "type"=>"category",
            "key"=> $category->name,
            "name"=> $category->name,
            "icon"=>$category->icon,
        ]);
    }
    $priceRange=($minPrice?$minPrice:0)." EUR~".($maxPrice?$maxPrice:4000)." EUR";
    if(($maxPrice || $minPrice) && ($minPrice!=0 || $maxPrice!=4000))array_push($this->filters,[
        "type"=>"price",
        "key"=>"min_price",
        "name"=> $priceRange,
        "icon"=>'fa-money-bill',
    ]);
    if($online)array_push($this->filters,[
        "type"=>"online",
        "key"=> $online,
        "name"=> $online == 1?"En ligne":"Hors ligne",
        "icon"=>'fa-user',
    ]);
        
    $filters = $this->filters;
    return view('livewire.applied-filter', compact('filters','departments','types', 
    'offersCount'));

    }
    
    public function remove(Request $request, $type,$key){
        if($type == "department"){
            $request->request->remove("departments.".$key);
        }
        else if($type == "subcategory"){
            $request->request->remove("subcategories.".$key);
        }else{
            $request->request->remove($key);
        }
    }
    
    public function applyFrom(Request $request){
        $request->flash();
        return route('alloffers.index');
    }
}
