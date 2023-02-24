<?php

namespace App\Http\Livewire\Banners;

use Livewire\Component;
use App\Models\Action;

class PromoOnMainBannerLivewire extends Component
{
    public $item_id, $data;

    public function mount()
    {
        $this->data = Action::where('on_main', 1)->get();
    }

    public function render()
    {
        return view('livewire.banners.promo-on-main-banner-livewire');
    }
}
