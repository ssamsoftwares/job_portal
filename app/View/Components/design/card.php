<?php

namespace App\View\Components\design;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card extends Component
{
    /**
     * Create a new component instance.
     */
    public $value,$desc,$icon;
    public function __construct($value="0", $desc="",$icon="fa fa-user")
    {
        $this->value = $value;
        $this->desc = $desc;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.design.card');
    }
}
