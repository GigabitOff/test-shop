<?php

namespace App\Http\Livewire\Widgets\Brands;

use App\Models\Brand;
use Illuminate\Support\Collection;
use Livewire\Component;

class WidgetBrandIndexLivewire extends Component
{

    public Collection $brands;

    public function mount()
    {
        $this->brands = $this->homePageBrands();
    }

    public function render()
    {
        return view('livewire.widgets.brands.widget-brand-index-livewire');
    }

    protected function homePageBrands(): Collection
    {
        $brands = Brand::orderBy('order', 'ASC')
            ->withTranslation()
            ->with(['mainImage'])
            ->where('status', true)
            ->get();

        $brands
            ->each(function (Brand $brand) {
                $this->expandWithImage($brand);
            });

        return $brands->filter->imageSrc;
    }

    protected function expandWithImage(Brand $brand)
    {
        $brand->imageSrc = fallbackBrandImageUrl($brand->imageFullUrl);
    }

}
