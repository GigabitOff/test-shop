<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Page;

class PageAboutController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'about')->where('status', 1)->with('translation')->get()->first();
        if (!isset($page))
            return redirect()->route('main');

        $brands = Brand::query()
            ->withTranslation()
            ->with(['mainImage'])
            ->where('status', true)
            ->orderBy('order','ASC')
            ->get()
            ->each(function (Brand $brand) {
                $brand->imageSrc = fallbackBrandImageUrl($brand->imageFullUrl);
            });

        $settings = $page->settings()->get()->keyBy('key')->toArray();
        return view('pages.about.index', compact( 'page','brands','settings'));
    }
}
