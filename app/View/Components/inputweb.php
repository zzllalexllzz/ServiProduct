<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class inputweb extends Component
{
    public $type;
    public $name;
    public $value;
    public $texto;
    /**
     * Create a new component instance.
     */
    public function __construct($type, $name, $value, $texto)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->texto = $texto;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputweb');
    }
}
