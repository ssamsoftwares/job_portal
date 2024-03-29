<?php

namespace App\View\Components\frontend\snippets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class logo extends Component
{
    /**
     * Create a new component instance.
     */
    public $show;
    public function __construct($show)
    {
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.snippets.logo');
    }
}
