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

class FilterSome extends Component
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
        $departments_sm = Department::all();
        $regions_sm = Region::all();
        $types_sm =Type::all();
        $query_sm =request()->input('query');
        $category_sm =request()->input('category'); // Retrieve the selected category
        $department_sm =request()->input('department');
        $region_sm =request()->input('region');
        $type_sm =request()->input('type');
        $minPrice_sm =request()->input('min_price');
        $maxPrice_sm =request()->input('max_price');
        
        $categoryName_sm = Category::where('id', $category_sm)->value('name');


        $parentcategories_sm = Category::whereNull('parent_id')->get();



        return view('components.filter-some', compact('departments_sm','types_sm',
            'categoryName_sm','parentcategories_sm','regions_sm'));
    }
}
