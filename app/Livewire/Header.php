<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 
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
        if($this->user){
        $this->notifications=$this->user->unreadNotifications->where('type','!=','App\Notifications\NewMessage');
        $this->messages=$this->user->unreadNotifications->where('type','==','App\Notifications\NewMessage');
    }}
    
    public function render()
    {
        return view('livewire.header');
    }

    public function read($messageId){
        $notif=$this->user->notifications
        ->where('id','==',$messageId)->first();
        $notif->markAsRead();
        return redirect($notif->data["link"]);
    }
    public function delete($notifId){
        $this->user->notifications
            ->where('id','==',$notifId)->first()->delete();
        $this->dispatch('refreshData');
    }

    #[On('echo:private-App.Models.User.{user.id},.Illuminate\Notifications\Events\BroadcastNotificationCreated')] 
    #[On('refreshData')] 
    public function refreshData()
    {
        $this->notifications=$this->user->unreadNotifications->where('type','!=','App\Notifications\NewMessage');
        $this->messages=$this->user->unreadNotifications->where('type','==','App\Notifications\NewMessage');
    }

}
