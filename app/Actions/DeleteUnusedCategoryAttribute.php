<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

class DeleteUnusedCategoryAttribute
{
    /**
     * Очистка устаревших атрибутов
     *
     * Удаляем все атрибуты со статусом main=1 из категорий для которых нет
     * соответствующих привязанных товаров в этой категории
     *
     *  Схема таблиц покоторым построен запрос
     *
     *  category-products            product-term
     *  +-------------+             +--------------+
     *  | product_id  | <---------  | product_id   |
     *  | category_id | <----+      | attribute_id | <--+
     *  +-------------+      |      +--------------+    |
     *                       |                          |
     *                       |      category-attribute  |
     *                       |      +---------------+   |
     *                       |      | attribute_id  | --+
     *                       +----- | category_id   |
     *                              +---------------+
     *
     * @return void
     */
    public function __invoke()
    {
        // Can not use table aliases for delete clause
        DB::table('category_attribute')
            ->where('main', true)
            ->whereNotExists(function ($q){
                $q->select(DB::raw(1))
                    ->from('product_term as pt')
                    ->join('category_product as cp', 'cp.product_id', '=', 'pt.product_id')
                    ->where('cp.category_id', DB::raw('category_attribute.category_id'))
                    ->where('pt.attribute_id', DB::raw('category_attribute.attribute_id'));
            })->delete();
    }
}
