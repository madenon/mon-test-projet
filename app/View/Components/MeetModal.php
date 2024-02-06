<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MeetModal extends Component
{
    
    public $preposition;
    /**
     * Create a new component instance.
     */
    public function __construct($preposition)
    {
        $this->preposition = $preposition;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meet-modal');
    }
}
