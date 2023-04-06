<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Components\ProductPriceTracker;
use App\Models\Category;
use App\Models\ProductPriceTracking;
use App\Services\LayoutDetectorService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Log;

class CatalogProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('catalog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id, CategoryService $service, Request $request)
    {
        $data = Product::where('id', (int)$id)
            ->orWhere('slug', $id)
            ->with([
                'accompanying' => function ($q) {
                    $q->with('images', 'brands');
                },
            ])
            ->with([
                'categories.translations',
                'instructions',
                'brand.images',
                'attributeValues.translations',
                'attributeValues.attribute.translations',
                'comparisonProducts',
            ])
            ->with([
                'translations' => function ($q) {
                    $q->where('locale', session('lang') ?? config('app.fallback_locale'));
                },
            ])
            ->firstOrFail();

        $images = $data->images()->orderBy('main', 'desc')->get();

        $params = array_filter(explode('/', parse_url($request->headers->get('referer'), PHP_URL_PATH)));

        if ($params && in_array('catalog', $params)) {
            $lastSegment = array_pop($params);
            $category = Category::query()
                ->where('slug', $lastSegment)
                ->whereRelation('products', 'id', '=', $data->id ?? 0)
                ->first();
        }

        $category = $category ?? $data->categories()->first();

        $breadcrumbs = $service->makeCatalogBreadcrumbsList($category, true);

        $layoutDetector = new LayoutDetectorService();
        $mode = $layoutDetector->detectMode($data);
        $columns = $layoutDetector->countColumns($mode);
        // The mode is a binary value string to search an appropriate product layout template,
        // E.g. layout variant 8 is mapped to blade template livewire.catalog.product.layouts.variant-10101
        $layout = [
            'mode'    => sprintf('%05b', $mode),
            'columns' => $columns,
        ];
        $action = ProductPriceTracker::ACTION_NOTHING;
        $data->showPriceTracking = true;
        try {
            // check external requests (links in emails, sms, QR-codes etc)
            if (!empty($hash = $request->get('unsubscribe'))) {
                $tracker = ProductPriceTracking::where('hash', $hash)->first();
                if (!empty($tracker)) {
                    if (auth()->user()) {
                        $tracker->delete();
                        $action = ProductPriceTracker::ACTION_SHOW_UNSUBSCRIBED_MESSAGE;
                    } else {
                        session(['unsubscribe_hash' => $tracker->hash]);
                        $action = ProductPriceTracker::ACTION_REGISTER_AND_UNSUBSCRIBE;
                    }
               }
            } else {
                if (!empty($request->get('add-to-cart'))) {
                    $action = auth()->user() ?
                        ProductPriceTracker::ACTION_ADD_TO_CART :
                        ProductPriceTracker::ACTION_REGISTER_AND_ADD_TO_CART;
                }/* else {
                    $action = session('follow_price_action', ProductPriceTracker::ACTION_NOTHING);
                }*/
            }
            ProductPriceTracker::persistAction($action);
            if (auth()->user()) {
                $tracker = ProductPriceTracking::where([
                    'customer_id' => auth()->user()->id,
                    'product_id'  => $data->id,
                ])->first();
                if (!empty($tracker)) {
                    $data->showPriceTracking = false;
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        if (empty($data->seo_canonical)) {
            $data->seo_canonical = route('products.show', ['product' => $data->slug], false);
            $data->translations[0]->save();
        }

        return view('catalog.product.show', compact('id', 'data', 'breadcrumbs', 'images', 'layout', 'action'));
    }

}
