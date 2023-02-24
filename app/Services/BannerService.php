<?php

namespace App\Services;

use App\Models\Banner;

class BannerService
{
    /**
     * Gets an ad banner on a page.
     *
     * @return object
     */
    public static function Banner($slug)
    {
        return  Banner::query()
                ->whereStatus(true)
                ->whereHas('page', fn($q) => $q->where('slug', $slug))
                ->first();
    }
}
