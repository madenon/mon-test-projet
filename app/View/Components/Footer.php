<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class Footer extends Component
{
    public $parentcategories;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $categories
     * @return void
     */
    public function __construct()
    {
        $this->parentcategories = Category::whereNull('parent_id')->get();
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
