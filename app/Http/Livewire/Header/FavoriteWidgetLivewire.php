<?php

namespace App\Http\Livewire\Header;

use Livewire\Component;

class FavoriteWidgetLivewire extends Component
{

    protected $listeners = [
        'eventFavouritesChanged',
    ];

    public function render()
    {
        return view('livewire.header.favorite-widget-livewire', [
            'count' => favourites()->count(),
        ]);
    }

    public function eventFavouritesChanged()
    {
        // Just for redraw
    }
}
