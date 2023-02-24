<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TestingLayout extends Component
{

    public string $title;

    public function __construct($title = '')
    {
        $this->title = $title
            ? $title . '-' . config('app.name', 'Laravel')
            : config('app.name', 'Laravel');
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.testing');
    }
}
