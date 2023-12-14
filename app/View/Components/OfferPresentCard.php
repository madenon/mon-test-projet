<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OfferPresentCard extends Component
{
    public $offer;
    public function __construct($offer)
    {
        //
        $this->offer=$offer;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.offer-present-card');
    }
}
