<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{

    public string $bodyClasses;
    public string $title;

    public function __construct($bodyClasses = '', $title = '')
    {
        $this->bodyClasses = $bodyClasses;
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
        return view('layouts.app');
    }
}
