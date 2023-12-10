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

class Filters extends Component
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
        
        $categoryName = Category::where('id', $category)->value('name');


        $parentcategories = Category::whereNull('parent_id')->get();



        return view('components.filters', compact('departments','types',
            'categoryName','parentcategories','regions'));
    }
}
