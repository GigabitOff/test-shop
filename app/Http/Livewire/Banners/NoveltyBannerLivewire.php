<?php

namespace App\Http\Livewire\Banners;

use Livewire\Component;

class NoveltyBannerLivewire extends Component
{
    public $banners;

    public function render()
    {
        return view('livewire.banners.novelty-banner-livewire');
    }
}
