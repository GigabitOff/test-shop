<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Page;
use App\Modules\Localization\LocalizationService;
use Illuminate\Contracts\Auth\StatefulGuard;

class MainController extends Controller
{

    public function index()
    {
        $page = Page::where('slug', 'main')->where('status', 1)->firstOrFail();

        $banners = Banner::where('page_id', $page->id)
            ->where('status', true)
            ->orderBy('order','ASC')->get();

        $slide_banners = $banners->filter(fn($el) => $el->from_banner == 0);
        $banners = $banners->filter(fn($el) => $el->from_banner == 1);

        return view('pages.home', compact('page', 'banners', 'slide_banners'));
    }


    public function logout(StatefulGuard $guard)
    {
        $guard->logout();

//        session()->invalidate();
//
//        session()->regenerateToken();

        session()->forget('password_hash_web');

        return redirect()->route('main');
    }

    public function setLocale($locale)
    {
        return LocalizationService::setLocale($locale);
    }

    public function unregisteredCart()
    {
        return view('client.cart.index-unregistered');
    }
}
