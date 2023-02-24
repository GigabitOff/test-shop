<?php

namespace App\Http\Livewire\Header;

use Livewire\Component;

class CompareWidgetLivewire extends Component
{

    protected $listeners = [
        'eventComparisonsChanged',
    ];

    public function render()
    {
        return view('livewire.header.compare-widget-livewire', [
            'count' => comparisons()->count(),
        ]);
    }

    public function eventComparisonsChanged()
    {
        // Just for redraw
    }
}
