<?php

namespace App\Livewire;

use Livewire\Component;

class SplitLongText extends Component
{
    public $text;
    public $len;
    public $parentClass;
    
    public function mount($text, $parentClass, $len=10)
    {
        $this->text = $text;
        $this->parentClass = $parentClass;
        $this->len = $len;
    }
    
    public function render()
    {
        return view('livewire.split-long-text');
    }
}
