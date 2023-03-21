<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\CategoryService;

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
                'comparisonProducts' => function ($q) {
                    $q->with('attributeValues.translations');
                },
            ])
            ->with([
                'accompanying' => function ($q) {
                    $q->with('images', 'brands');
                },
            ])
            ->with([
                'categories.translations',
                'brand.images',
                'attributeValues.translations',
                'attributeValues.attribute.translations',
                'comparisonProducts',
            ])
            ->firstOrFail();

        // set layout properties
        $isVariationsVisible = !empty($data->vars_attrs) && !empty($data->vars_key);
        $isAttributesVisible = !empty($data->attributeValues->count());
        $isThreeColumns = !$isVariationsVisible && $isAttributesVisible;
        $isDescriptionVisible = !empty($data->technical_description);
        $isAccompaynigVisible = !empty($data->accompanying->count());
        $isReviewsVisible = !empty(Review::where(
            [
                'product_id' => $data->id ?? 0,
                'status'     => 1,
            ])
            ->count()
        );
        $layout = [
            'isVariationsVisible'  => $isVariationsVisible,
            'isAttributesVisible'  => $isAttributesVisible,
            'isAccompaynigVisible' => $isAccompaynigVisible,
            'isDescriptionVisible' => $isDescriptionVisible,
            'isReviewsVisible'     => $isReviewsVisible,
            'isThreeColumns'       => $isThreeColumns,
        ];

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

        return view('catalog.product.show', compact('id', 'data', 'breadcrumbs', 'images', 'layout'));
    }

}
