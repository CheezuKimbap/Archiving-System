<?php

namespace App\View\Components\Maintenance;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class table extends Component
{
    public $speciesType;
    /**
     * Create a new component instance.
     */
    public function __construct($speciesType = null)
    {
        $this->speciesType = $speciesType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.maintenance.table');
    }
}
