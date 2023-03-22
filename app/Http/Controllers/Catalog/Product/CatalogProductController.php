<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Review;
use App\Services\LayoutDetectorService;
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
                'instructions',
                'brand.images',
                'attributeValues.translations',
                'attributeValues.attribute.translations',
                'comparisonProducts',
            ])
            ->firstOrFail();
flog($data->instructions->count());
        $layoutDetector = new LayoutDetectorService();
        $mode = $layoutDetector->detectMode($data);
        $columns = $layoutDetector->countColumns($mode);
        // The mode is a binary value string to search an appropriate product layout template,
        // E.g. layout variant 8 is mapped to blade template livewire.catalog.product.layouts.variant-10101
        $layout = [
            'mode'    => sprintf('%05b', $mode),
            'columns' => $columns,
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
