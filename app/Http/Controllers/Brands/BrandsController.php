<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\BannerService;

class BrandsController extends Controller
{
    public function index()
    {
        return redirect()->route('main');
    }

    /**
     * Display a brand page.
     */
    public function show($slug)
    {
        $brand = Brand::query()
            ->select('id')
            ->with(['mainImage'])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $banner = BannerService::Banner('brands');

        return view('pages.brands.show', compact('brand', 'banner'));
    }

}
