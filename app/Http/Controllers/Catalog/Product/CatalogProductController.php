<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;

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
     * @param  int  $id
     */
    public function show($id,CategoryService $service, Request $request)
    {
        $data = Product::where('id', (int)$id)
                ->orWhere('slug',$id)
                ->with(['accompanying'=>function($q){
                    $q->with('images', 'brands');
                }])
                ->with(['categories.translations', 'brand.images',
                    'attributeValues.translations', 'attributeValues.attribute.translations'])
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

        return view('catalog.product.show', compact('id','data', 'breadcrumbs', 'images'));

    }

}
