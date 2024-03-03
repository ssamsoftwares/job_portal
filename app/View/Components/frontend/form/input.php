<?php

namespace App\View\Components\frontend\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     */

    public $name, $label, $value, $type,$disabled = false,$placeholder,$required;
    public function __construct($name, $label=null, $value=null, $type="text",$disabled = false,$placeholder="",$required = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.form.input');
    }
}
