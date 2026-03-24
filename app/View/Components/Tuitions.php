<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tuition;
class Tuitions extends Component
{
    public $tuitions = [];
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        $this->tuitions = Tuition::latest()->limit(20)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tuitions');
    }
}
