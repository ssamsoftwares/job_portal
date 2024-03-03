<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public $name, $label, $value, $rows, $required;

    public function __construct($name, $label, $value = null, $rows = 0, $required = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->rows = $rows;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.textarea');
    }
}
