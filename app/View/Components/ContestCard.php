<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContestCard extends Component
{
    public $contest;
    public function __construct($contest)
    {
        //
        $this->contest=$contest;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contest-card');
    }
}
