<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductVisit;
use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Page;
use Illuminate\Support\Facades\Cookie;

class PageActionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 12;
        if($request->perPage) $perPage = $request->perPage;

        $page = Page::where('slug','actions')->where('status',1)->first();
        if (!isset($page))
            return redirect('/'.app()->currentLocale());

        $data = Action::where('status',true)->with('translation')
            ->paginate($perPage)
            ->appends(request()->query());
        $banners = Banner::where('page_id', $page->id)->where('status', true)->get();
        return view('pages.action.index', compact('data','page','banners','perPage'));
    }

    public function show($id)
    {
        $page = Page::where('slug','actions')->where('status',1)->first();
        $promotion = Action::query()->where('slug', $id)->first();
        if (!$page || !$promotion)
            return redirect('/'.app()->currentLocale());

        $userId = auth()->id();
        $userIp = request()->ip();

        $visits = ($userId || $userIp)
            ? Action::query()
                ->whereHas('visits', function ($query) use ($userId, $userIp) {
                    return $userId
                        ? $query->where('user_id', $userId)
                        : $query->where('ip', $userIp);
                })
                ->with(['translations'])
                ->get()
            : collect([]);

        return view('pages.action.show', compact('promotion','page', 'visits'));
    }
}
