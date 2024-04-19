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
    public $hiddenFilters = [];
    public $offersCount = 0;
    public $filterChanged = false;
    
    public function mount($offersCount){
        $this->offersCount = $offersCount;
    }
    
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
        


        
            
        if($type)array_push($this->filters,[
            "type"=>"type",
            "key"=> Type::find($type)->name,
            "name"=> Type::find($type)->name,
            'applied' => true
        ]);
        if($request->input('departments'))
        foreach($request->input('departments') as $dep){
            array_push($this->filters,[
                "type"=>"department",
                "name"=> Department::find($dep)->name,
                "key"=> Department::find($dep)->name,
                "icon"=>'fa-map-marker-alt',
                'applied' => true
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
                'applied' => true

            ]);  
        }
        if ($category){
            $category=Category::find($category);
            array_push($this->filters,[
                "type"=>"category",
                "key"=> $category->name,
                "name"=> $category->name,
                "icon"=>$category->icon,
                'applied' => true

            ]);
        }
        $priceRange=($minPrice?$minPrice:0)." EUR~".($maxPrice?$maxPrice:4000)." EUR";
        if(($maxPrice || $minPrice) && ($minPrice!=0 || $maxPrice!=4000))array_push($this->filters,[
            "type"=>"price",
            "key"=>"min_price",
            "name"=> $priceRange,
            "icon"=>'fa-money-bill',
            'applied' => true

        ]);
        if($request->has('online'))array_push($this->filters,[
            "type"=>"online",
            "key"=> $online,
            "name"=> $online == 1?"En ligne":"Hors ligne",
            "icon"=>'fa-user',
            'applied' => true

        ]);
            
    $filters = $this->filters;
    $offersCount = $this->offersCount;
    return view('livewire.applied-filter', compact('filters','departments','types', 
    'offersCount'));

    }
    
    public function remove(Request $request, $type,$key){
        // if($type == "department"){
        //     $request->request->remove("departments.".$key);
        // }
        // else if($type == "subcategory"){
        //     $request->request->remove("subcategories.".$key);
        // }else{
        //     $request->request->remove($key);
        // }
        $this->filterChanged = true;
        $this->hiddenFilters[] = $type;
        
    }
    
    public function applyFrom(Request $request){
        $request->session()->flash('input', $request->all());
        return redirect()->route('alloffers.index');
    }
}
