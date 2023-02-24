<?php

namespace App\Http\Livewire\Customer\Widget;

use App\Models\Banner;
use Livewire\Component;

class BannerWidgetLivewire extends Component
{
    public array $content = [];

    public function mount()
    {

        $banner = Banner::query()
            ->whereStatus(true)
            ->whereHas('page', fn($q) => $q->where('slug', 'main-lk'))
            ->first();

        logger()->info($banner);
        $this->content = [
            'link' => $banner->link ?? '',
            'image' => $banner->imageFullUrl ?? '',
            'title' => $banner->title ?? '',
        ];
    }

    public function render()
    {
        return view(
            'livewire.customer.widget.banner-widget-livewire');
    }

}
