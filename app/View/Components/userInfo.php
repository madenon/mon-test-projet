<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\UserInfos;


class userInfo extends Component
{
    public $user;
    public $offerPrepostion;
    public $userInfo;
    public $medalBronzeSilver;
    public $medalSilverGold;
    public $ratingsCount;
    public $ratingsAvg;
    public $followersCount;
    public $finishedOffers;
    public $offersInProgress;
    /**
     * Create a new component instance.
     */
    public function __construct($user)
    {
        $offers = $user->offer;
        $this->user = $user;
        $mesPropositions=$user->prepositions;
        $totalTransactions = 0;
        $totalTransactionsFromOffers = 0;
        foreach ($offers as $offer) {
            // Count transactions from propositions of the offer
            $totalTransactionsFromOffers += $offer->preposition->flatMap->transactions
                ->where('offeror_status', 'Réussi')
                ->where('applicant_status', 'Réussi')
                ->count();
        }

        // Count transactions from propositions
        $totalTransactionsFromMesPropositions = $mesPropositions->flatMap->transactions
        ->where('offeror_status', 'Réussi')
        ->where('applicant_status', 'Réussi')
            ->count();

        // Total transactions
        $totalTransactions = $totalTransactionsFromOffers + $totalTransactionsFromMesPropositions;

        $this->userInfo = UserInfos::where('user_id', $user->id)->first();
        $this->offerPrepostion = $mesPropositions->count();
        $this->finishedOffers =$totalTransactions ;
        $this->offersInProgress = $user->offer()->whereNull('deleted_at')->get()->count();

        $this->medalBronzeSilver=30;
        $this->medalSilverGold=60;

        $ratings=$user->ratings;
        $this->ratingsCount=$ratings->count();
        $this->ratingsAvg=$ratings->avg('stars');
        $this->followersCount=$user->followings->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-info');
    }
}
