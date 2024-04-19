<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Enums\Condition;
use App\Enums\ExperienceLevel;
use App\Models\Category;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Preposition;
use App\Models\Region;
use App\Models\Type;
use App\Models\UserInfos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\OfferImages;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


class EditOffer extends Component
{
    public $offer;
    public $route;
    public function __construct($offer, $route)
    {
        $this->offer = $offer;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = Auth::user();
        $categories = Category::whereNull("parent_id")->get();
        $subcategories = Category::where("parent_id", '!=', NULL)->get();
        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all();
        $offer = $this->offer;
        $experienceLevels = ExperienceLevel::toArray();
        $conditions = Condition::toArray();
        $images = OfferImages::where('offer_id',$offer->id)->get();


        return view('components.edit-offer', compact(
            'user',
            'types',
            'departments',
            'regions',
            'categories',
            'offer',
            'subcategories',
            'experienceLevels',
            'conditions',
            'images'
        ));
    }
}
