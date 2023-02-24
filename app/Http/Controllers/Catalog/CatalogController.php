<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Filter;
use App\Models\FilterSeo;
use App\Models\Banner;
use App\Services\BannerService;
use App\Services\SearchService;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $filters_seo;

    public function __construct()
    {
//        $filters_seo = FilterSeo::where('status', true)->withTranslation('uk')->get()
//            ->each(function ($seo) {
//                $seo->hash = md5($seo->url);
//            })
//            ->keyBy('hash');
//        // dd($filters_seo);
//        if (count($filters_seo) > 0)
//            $this->filters_seo = $filters_seo->toArray();

    }

    public function index(Request $request, CategoryService $service)
    {
        $banner = BannerService::Banner('katalog');

        $breadcrumbs = $service->makeCatalogBreadcrumbsList(null, false);

        return view('catalog.category.show', compact('banner', 'breadcrumbs'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param CategoryService $service
     */
    public function show($id, CategoryService $service)
    {
        $filter_seo = FilterSeo::whereTranslation('seo_url', $id)->first();

        //$category = Category::where('slug', $id)->first();

        if ($filter_seo)
            return redirect($filter_seo->url);


        /**
         * Выполняем поиск только корневой либо дочерней к корневой категории.
         * Иначе 404
         */
        $category = Category::where('slug', $id)
            ->with(['translations', 'children'])
            ->where(function ($q) {
                $q->where('parent_id', 0);
                $q->orWhereRelation('parent', 'parent_id', '0');
            })
            ->firstOrFail();

        $banner = BannerService::Banner('katalog');

        $breadcrumbs = $service->makeCatalogBreadcrumbsList($category, false);

        $filterCategory = $category->parent_id ?: $category->id;
        $filter = $filterCategory
            ? Filter::query()->where('category_id', $filterCategory)
                ->whereStatus(true)->first()
            : null;

        return view('catalog.category.show', compact('category', 'filter', 'banner', 'breadcrumbs'));

    }

}
