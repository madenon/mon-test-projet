<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PrepositionValidationModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($preposition)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.preposition-validation-modal');
    }
}
