<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Information;
use Illuminate\View\Component;

class Footer extends Component
{
    public $parentcategories;
    public $information;


    /**
     * Create a new component instance.
     *
     * @param  mixed  $categories
     * @return void
     */
    public function __construct()
    {
        $this->parentcategories = Category::whereNull('parent_id')->get();
        $this->information = Information::first(); // only one row in the table

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.footer');
    }
}
