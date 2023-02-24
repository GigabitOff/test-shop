<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Service;
use App\Services\BannerService;

class PageController extends Controller
{
    public $lang;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page_privacy_policy()
    {
        $this->lang = app()->currentLocale();
        $privacyPolicy = Page::translatedIn($this->lang)->where('slug', 'polityka-konfidenciynosti')->where('status', 1)->get()->first();
        if (!isset($privacyPolicy->title) or $privacyPolicy->title == "")
            return redirect()->route('main');

        $banner = BannerService::Banner('polityka-konfidenciynosti');

        if (!isset($privacyPolicy))
            return redirect()->route('main', ['lang' => $this->lang]);

        return view('pages.page.privacy-policy', compact('privacyPolicy', 'banner'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $slug = null)
    {
        if (!$slug)
            $slug = $lang;
        $exclude = [
            'brands'=> 'brands',
            'news'=> 'news',
            'reviews' => 'reviews',
            'contucts' => 'contucts',
        ];
        if(isset($exclude[$slug]))
            return redirect()->route('main');

        $this->lang = app()->currentLocale();

        $data = Page::translatedIn(app()->currentLocale())
                ->where('status', 1)
                ->where('slug', $slug)
                ->get()
                ->first();

        $banner = BannerService::Banner($slug);

        if (!isset($data->title))
            return redirect()->route('main');

        if(in_array($slug, array('privacy-policy', 'services'))) {
            $view = 'page.' . $slug;
        } else {
            $view = 'show';
        }

        return view('pages.' . $view, compact('data', 'banner'));
    }

    /**
     * Display the services data.
     *
     * @return \Illuminate\Http\Response
     */
    public function services(){

        $slug = 'services';

        $services = Page::translatedIn(app()
                    ->currentLocale())
                    ->select('id')
                    ->where('status', 1)
                    ->where('slug', $slug)
                    ->firstOrFail();

        $banner = BannerService::Banner($slug);

        return view('pages.page.'.$slug, compact('services', 'banner'));
    }

    public function show_singl($lang, $id = null)
    {

        if (!$id)
            $id = $lang;


        $this->lang = app()->currentLocale();
        $data = Page::translatedIn(app()->currentLocale())->where('status', 1)->where('slug', $id)->get()->first();
        $slug = $id;
        if (!isset($data->title) or $data->title == "")
            return redirect('/' . $this->lang);

        if ($id == 'produkciya-yaka-potrebuje-zamishhennya') {
            $showCat2 = 'page-pdf';


            return view('pages.produkciya-yaka-potrebuje-zamishhennya', compact('slug', 'data', 'showCat2'));
        }


        return view('pages.show_singl', compact('slug', 'data'));
    }

    public function delivery_payment()
    {
        $this->lang = app()->currentLocale();
        $deliveryPayment = Page::translatedIn(app()->currentLocale())->where('status', 1)->where('slug', 'delivery-payment')->get()->first();


        if (!isset($deliveryPayment->title) or $deliveryPayment->title == "")
            return redirect('/' . $this->lang);

        return view('pages.delivery-payment.show', compact('deliveryPayment'));

    }

    public function informationProcessing(){

        $this->lang = app()->currentLocale();

        $informationProcessing = Page::translatedIn(app()->currentLocale())->where('status', 1)->where('slug', 'privacy-policy')->get()->first();

        $banner = BannerService::Banner('polityka-konfidenciynosti');

        if (!isset($informationProcessing) or $informationProcessing == "")
            return redirect('/' . $this->lang);

        return view('pages.information.index', compact('informationProcessing', 'banner'));
    }
}
