<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Region;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
    public $parentcategories;
    public $regions;
    public $user;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $categories
     * @return void
     */
    public function __construct()
    {
        $this->parentcategories = Category::whereNull('parent_id')->get();
        $this->regions=Region::all();
        $this->user = User::find(Auth::user()->id);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.header');
    }
}
