<?php

namespace App\Http\Livewire\Customer\Widget;

use App\Models\User;
use App\Repositories\FavoriteRepository;
use Livewire\Component;

class FavoritesWidgetLivewire extends Component
{
    public function render()
    {
        /** @var User */
        $user = auth()->user();

        $count = FavoriteRepository::countByUser($user);
        return view('livewire.customer.widget.favorites-widget-livewire', [
            'count' => $count,
        ]);
    }

}
