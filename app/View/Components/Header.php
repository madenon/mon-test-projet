<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Preposition;
use App\Models\Region;
use App\Models\Notification;

use App\Models\User;
use App\Models\Offer;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
    public $parentcategories;
    public $regions;
    public $user;
    public $propositions;
    public $notifications;

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

        if(Auth::user()!=null){
        $this->user = User::find(Auth::user()->id);
        $offers = Offer::where('user_id', Auth::user()->id)->get();
        $this->propositions = $offers->flatMap(function ($offer) {
            return $offer->preposition->where('status', 'En cours');
        });
        $this->notifications=Notification::where('user_id', Auth::user()->id)            
        ->where('seen', 0)
        ->get();
    }
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
