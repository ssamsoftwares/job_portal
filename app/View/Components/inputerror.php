<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class inputerror extends Component
{
    /**
     * Create a new component instance.
     */
    public $messages, $name;
    public function __construct($name, $messages)
    {
        $this->name = $name;
        $this->messages = $messages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-error');
    }
}
