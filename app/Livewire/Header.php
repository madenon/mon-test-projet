<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Preposition;
use App\Models\Region;
use App\Models\Notification;
use App\Models\User;
use App\Models\Offer;

class Header extends Component
{
    public $parentcategories;
    public $regions;
    public $user;
    public $notifications;
    public $messages;

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
        }
        $this->notifications=$this->user->notifications->where('type','!=','App\Notifications\NewMessage');
        $this->messages=$this->user->notifications->where('type','==','App\Notifications\NewMessage');
    }

    public function render()
    {
        return view('livewire.header');
    }

    public function read($isMessages){
        if($isMessages==1)$this->user->notifications
            ->where('type','==','App\Notifications\NewMessage')->markAsRead();
        else $this->user->notifications
            ->where('type','!=','App\Notifications\NewMessage')->markAsRead();
    }
    public function delete($notifId){
        $this->user->notifications
            ->where('id','==',$notifId)->first()->delete();
        header("Refresh:0");

    }
}
