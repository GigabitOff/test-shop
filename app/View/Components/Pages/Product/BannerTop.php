<?php

namespace App\View\Components\Pages\Product;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\View\Component;

class BannerTop extends Component
{
    const PRODUCT_PAGE_SLUG = 'product';

    public Product $product;

    public ?Banner $banner;
    public string $backUrl;

    public function __construct(Product $product)
    {
        $this->product = $product;

        $this->evaluateBackUrl();
        $this->evaluateBanner();
    }

    public function render()
    {
        return view('components.pages.product.banner-top');
    }

    /**
     * Опрделяем url возврата
     *
     * @return void
     */
    protected function evaluateBackUrl()
    {
        if ($referrer = request()->header('referer')){
            $host = parse_url($referrer, PHP_URL_HOST);

            if ($host === request()->getHost() && $referrer !== request()->url()) {
                $url = $referrer;
            }
        }

        $this->backUrl = $url ?? route('catalog.index');
    }

    protected function evaluateBanner()
    {
        $this->banner = Banner::query()
            ->whereHas('location', function ($q){
                $q->whereHas('page', fn($q2) => $q2->where('slug', self::PRODUCT_PAGE_SLUG));
            })
            ->where('status', 1)
            ->first();

        if ($this->banner){
            $this->expandBgImage($this->banner);
        }
    }

    protected function expandBgImage(Banner $banner): void
    {
        $banner->bgImageUrl = (\Storage::disk('public')->exists($banner->image))
            ? \Storage::disk('public')->url($banner->image)
            : '';
    }
}
