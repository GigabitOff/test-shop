<?php

namespace App\Http\Livewire\Manager\Widget;

use App\Models\User;
use App\Models\UserGeoIp;
use Livewire\Component;

class GeographyClientsWidget extends Component
{
//    protected ?User $user;

    public function boot()
    {
//        $this->user = auth()->user();
    }

    public function render()
    {
        $locations = UserGeoIp::query()
            ->select('latitude as lat', 'longitude as lng')
            ->toBase()->get();

        return view('livewire.manager.widget.geography-clients-widget', [
            'locations' => $locations
        ]);
    }

}
