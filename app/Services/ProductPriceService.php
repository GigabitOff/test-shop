<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProductPriceService
{
    /**
     * Clear Brand discount for product
     *
     * @param int $productId
     */
    public function clearProductBrandDiscount(int $productId)
    {
        $this->clearProductTypeDiscount($productId, 'brand');
    }

    /**
     * Clear Group discount for product
     *
     * @param int $productId
     */
    public function clearProductGroupDiscount(int $productId)
    {
        $this->clearProductTypeDiscount($productId, 'group');
    }

    /**
     * Clear Category discount for product
     *
     * @param int $productId
     */
    public function clearProductCategoryDiscount(int $productId)
    {
        $this->clearProductTypeDiscount($productId, 'category');
    }

    /**
     * Clear Product discount for product
     *
     * @param int $productId
     */
    public function clearProductDiscount(int $productId)
    {
        $this->clearProductTypeDiscount($productId, 'product');
    }

    /**
     * Clear certain type discount for product
     *
     * @param int $productId
     * @param string $type // One of brand, group, category, product
     * @return void
     */
    public function clearProductTypeDiscount(int $productId, string $type)
    {
        if ($productId) {
            DB::table('product_user_price')
                ->where('product_id', $productId)
                ->update([$type => 0]);
        }
    }

    public function updateProductPriceInit(int $productId, float $price)
    {
        DB::table('product_user_price')
            ->where('product_id', $productId)
            ->update(['retail' => $price]);
    }


    /**
     * Обновляет скидки для конкретного товара по его бренду
     * @param Product $product
     * @return void
     */
    public function updateBrandDiscountForProduct(Product $product)
    {
        // Steps:
        // 1 - Clear all discounts
        // 2 - Find all brand discounts for all users
        // 3 - Group by discount
        // 4 - Eval price

        $this->clearProductBrandDiscount($product->id);

        /** @var Brand $brand */
        $brand = $product->brand;

        if (!$brand) {
            return;
        }

        $brand->usersDiscount()->wherePivot('discount', '!=', 0)
            ->chunk(500, function ($chunk) use ($product) {
                $chunk
                    ->groupBy(fn($el) => (string)$el->pivot->discount)
                    ->each(function ($group) use ($product) {
                        $discount = $group->first()->pivot->discount;
                        $usersId = $group->pluck('id')->toArray();

                        $pack = collect($usersId)->map(function ($userId) use ($product, $discount) {
                            return [
                                'user_id' => $userId,
                                'product_id' => $product->id,
                                'brand' => $discount,
                                'init' => $product->price_init,
                            ];
                        })->toArray();

                        DB::table('product_user_price')
                            ->upsert($pack, ['user_id', 'product_id'], ['brand', 'init']);
                    });
            });
    }

    /**
     * Обновляет скидки конкретного товара по его группам
     * @param Product $product
     * @return void
     */
    public function updateGroupDiscountForProduct(Product $product)
    {
        // Steps:
        // 1 - Clear all discounts
        // 2 - Find all groups discounts for all users
        // 3 - Group by discount
        // 4 - Eval price

        $this->clearProductGroupDiscount($product->id);

        /** @var Collection $groups */
        $groups = $product->groups;

        if ($groups->isEmpty()) {
            return;
        }

        foreach ($groups as $group) {
            $group->usersDiscount()->wherePivot('discount', '!=', 0)
                ->chunk(500, function ($chunk) use ($product) {
                    $chunk
                        ->groupBy(fn($el) => (string)$el->pivot->discount)
                        ->each(function ($group) use ($product) {
                            $discount = $group->first()->pivot->discount;
                            $usersId = $group->pluck('id')->toArray();

                            $pack = collect($usersId)->map(function ($userId) use ($product, $discount) {
                                return [
                                    'user_id' => $userId,
                                    'product_id' => $product->id,
                                    'group' => $discount,
                                    'init' => $product->price_init,
                                ];
                            })->toArray();

                            DB::table('product_user_price')
                                ->upsert($pack, ['user_id', 'product_id'], ['group', 'init']);
                        });
                });
        }
    }

    /**
     * Обновляет скидки конкретного товара по его категориям
     * @param Product $product
     * @return void
     */
    public function updateCategoryDiscountForProduct(Product $product)
    {
        // Steps:
        // 1 - Clear all discounts
        // 2 - Find all category discounts for all users
        // 3 - Group by discount
        // 4 - Eval price

        $this->clearProductCategoryDiscount($product->id);

        /** @var Collection $groups */
        $categories = $product->categories;

        if ($categories->isEmpty()) {
            return;
        }


        $ancestors = $this->getCategoryAncestors($categories->map->id->toArray());

        $categories->each(function ($cat) use ($ancestors) {
            // поиск корневого родителя и глубины вложенности.
            $cat->root = $ancestors->firstWhere('last_descendant', $cat->id);
            $cat->deep = $cat->root->deep;
        });

        // Определяем самые глубокие категории. По ним и будем определять скидку.
        $maxDeep = $categories->max->deep;
        $deeperCats = $categories->where('deep', $maxDeep);

        // собираем уникальный список всех родителей.
        $deeperCatAncestors = $deeperCats->map->root->map->descendants->flatten()->unique();


        // Цикл по всем пользователям, для которых надо поправить скидку
        DB::table('discount_category')
            ->where('discount', '!=', 0)
            ->whereIn('category_id', $deeperCatAncestors)
            ->orderBy('user_id')
            ->select('user_id')
            ->distinct()
            ->chunk(500, function($chunk) use($product, $deeperCatAncestors, $deeperCats){
                $usersId = $chunk->pluck('user_id');
                // выборка всех скидок для текущего набора пользователей
                $discounts = DB::table('discount_category')
                    ->where('discount', '!=', 0)
                    ->whereIn('user_id', $usersId)
                    ->whereIn('category_id', $deeperCatAncestors)
                    ->get();

                $pack = collect([]);
                foreach ($usersId as $userId) {
                    $userDiscounts = $discounts->where('user_id', $userId);
                    // Определяем доступную скидку для каждой категории.
                    $catDiscounts = $deeperCats->each(function ($cat) use($userDiscounts) {
                        foreach ($cat->root->descendants as $descendant) {
                            $discount = $userDiscounts->firstWhere('category_id', $descendant)->discount ?? 0;
                            if ($discount){
                                break;
                            }
                        }
                        $cat->discount = $discount ?? 0;
                    })->filter->discount->sortBy('discount');

                    $catDiscount = $catDiscounts->first();

                    //Формируем выходящий массив данных
                    $pack = $pack->push([
                        'user_id' => $userId,
                        'product_id' => $product->id,
                        'category' => $catDiscount->discount ?? 0,
                        'init' => $product->price_init,
                    ]);
                }

                DB::table('product_user_price')
                    ->upsert($pack->toArray(), ['user_id', 'product_id'], ['category', 'init']);

            });

    }

    /**
     * Получает список предков отсортированных по deep.
     *
     * Внимание!
     * Если в исходных данных есть категории состоящие в отношении предок => потомок, тогда в результате
     * будут присутствовать дубликаты отношений id => parent_id по одному для каждой искомой категории.
     *
     * @param array $categories
     * @return \Illuminate\Support\Collection // as StdObject (id, parent_id, deep, deep_line)
     */
    private function getCategoryAncestors(array $categories): \Illuminate\Support\Collection
    {
        $injection = implode(',', $categories);
        $rawSql = <<<SQL
            WITH RECURSIVE cte  AS (
                    SELECT t1.id, t1.parent_id, 1 as deep, CAST(t1.id AS CHAR) AS deep_line
                    FROM categories t1
                    WHERE t1.id IN ({$injection})
                    UNION ALL
                    SELECT t3.id, t3.parent_id, (t2.deep + 1) AS deep, CONCAT(t2.deep_line, '|', CAST(t3.id AS CHAR))
                    FROM categories t3, cte t2
                    WHERE t3.id = t2.parent_id
                )
            SELECT * /*id, parent_id, MAX(deep) AS deep, MAX(deep_line) AS deep_line*/
            FROM cte
            WHERE 1
            /*GROUP BY id, parent_id*/
            ORDER BY deep DESC;
        SQL;

        return collect(DB::select($rawSql))
            ->each(function ($el) {
                $el->descendants = collect(explode('|', $el->deep_line));
                $el->last_descendant = $el->descendants->first();
            });
    }
}
