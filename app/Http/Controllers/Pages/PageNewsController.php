<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductVisit;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Page;
use Illuminate\Support\Facades\Cookie;

class PageNewsController extends Controller
{
    public function index()
    {
        $page = Page::where('slug','news')->where('status',1)->first();
        if (!isset($page))
            return redirect('/'.app()->currentLocale());

        $data = News::where('status',true)->with('translation')->paginate(6);
        $banners = Banner::where('page_id', $page->id)->where('status', true)->get();
        return view('pages.news.index', compact('data','page','banners'));

    }

    public function show($slug)
    {
        $page = Page::where('slug','news')->where('status',1)->first();
        if (!isset($page))
            return redirect('/'.app()->currentLocale());

        $data = News::where('slug',$slug)->first();
        $news = News::with('translation')->where('status',true)
                    ->where('slug','!=',$slug)->get();
        return view('pages.news.show', compact('data','page','news'));
    }
}
