<?php

namespace App\View\Components\frontend\snippets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class authLogo extends Component
{
    /**
     * Create a new component instance.
     */
    public $show,$action,$heading,$actionPageName,$backBtnUrl;
    public function __construct($show,$action="#", $heading=null,$actionPageName=null,$backBtnUrl=null)
    {
        $this->show = $show;
        $this->action = $action;
        $this->heading = $heading;
        $this->actionPageName = $actionPageName;
        $this->backBtnUrl = $backBtnUrl;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.snippets.auth-logo');
    }
}
