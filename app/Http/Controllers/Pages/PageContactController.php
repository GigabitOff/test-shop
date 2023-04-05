<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Contuct;
use App\Models\UserGeoIp;
use App\Models\Page;
use App\Models\Shop;

class PageContactController extends Controller
{
    public function index()
    {
        /*$data = Contuct::translatedIn(app()->currentLocale())->where('status',1)->get();
        if(!$data)
        return redirect()->route('index',['lang'=>app()->currentLocale()]);
        */
        $page = Page::translatedIn(app()->currentLocale())->where('slug','contacts')->get()->first();
        if(!$page)
        return redirect()->route('index',['lang'=>app()->currentLocale()]);

        $banners = Banner::where('page_id', $page->id)->where('status', true)->get();
        $shops = Shop::where('status',true)
                ->with('translation')
                ->with('getContuct')
                ->get();
        //logger()->info($shop);
       // exit();

        $getLocations = Shop::query()
            ->where('coords_latitude','!=','')
            ->where('coords_longitude','!=','')
            ->select('coords_latitude as lat', 'coords_longitude as lng')
            ->toBase()->get();

        $locations = [];
        foreach ($getLocations as $v){
            $locations[] = [
                'lat' => (float) $v->lat,
                'lng' => (float) $v->lng,
            ];
        }


        return view('pages.contacts.index', compact('shops','page', 'locations', 'banners', 'getLocations'));
    }
}
