<?php

namespace App\View\Components;

use Illuminate\View\Component;

class forms.articles extends Component
{

    public $categories;
    public $unites;
    public $types;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories, $unites, $types)
    {
        $this->categories = $categories;
        $this->unites = $unites;
        $this->types = $types;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.articles');
    }
}
