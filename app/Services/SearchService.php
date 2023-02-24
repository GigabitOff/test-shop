<?php

namespace App\Services;

use App\Models\Product;


class SearchService
{

    /**
     * Получает список всех id найденных товаров.
     *
     * @return object
     */
    protected static $searchProductIds;

    public static function searchProductIds($search=null)
    {

        if(empty(self::$searchProductIds)){

            if ($search = preg_replace(array('/[\s]*[.]*[\s]+/'), '%', $search)) {

                $query= Product::query()->where(function($q) use($search) {
                        $q->whereTranslationLike('name', "%$search%")
                            ->orWhere('articul', 'like', "%$search%")
                            ->orWhere('articul_search', 'like', "%$search%")
                            //->orWhere('brand_search', 'like', "%$search%")
                            ->orwhereHas('translations', function ($que_ry) use($search){
                                $que_ry->where('technical_description', 'like', "%$search%");
                            })
                            ->orwhereHas('brand', function ($q_ry) use($search){
                                $q_ry->whereHas('translations', fn($q_ry) =>
                                    $q_ry->where('title', 'like', "%$search%"));
                                })
                            ->orWhere('price_init', 'like', "%$search%")
                            ->orwhereHas('attributeValues', function ($qr) use($search){
                                $qr->whereHas('translations', fn($qr) =>
                                    $qr->where('name', 'like', "%$search%"));
                            });
                    });
                    self::$searchProductIds = $query->pluck('id');
                }
            }
            return self::$searchProductIds;
    }
}
