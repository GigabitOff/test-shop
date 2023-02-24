<?php

namespace App\Services\Import;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PriceImportService extends BaseService
{

    /**
     * Импорт Персональных скидок клиента.
     * @param array $inputs
     * @return array
     */
    public function setUsersDiscounts(array $inputs): array
    {
        $typesInfo = [
            'brand' => ['table' => 'product_brands', 'model' => Brand::class],
            'category' => ['table' => 'categories', 'model' => Category::class],
            'group' => ['table' => 'product_groups', 'model' => ProductGroup::class],
            'product' => ['table' => 'products', 'model' => Product::class],
        ];

        $getTypeClass = fn(string $type) => $typesInfo[$type]['model'];

        $rules = [
            'discount' => 'required|numeric',
            'target_type' => 'required|in:brand,category,group,product',
            'targets_id_1c' => 'required',
            'users_id_site' => 'required_without:users_id_1c',
            'users_id_1c' => 'required_without:users_id_site',
        ];
        foreach ($inputs as $input) {
            if ($fail = $this->validate($input, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $usersId = tap(User::query(), fn($q) => $this->whereInModelScope($q, $input, 'users_'))
                ->pluck('id')->toArray();

            $class = $getTypeClass($input['target_type']);
            $targetsId = tap($class::query(), fn($q) => $this->whereInModelScope($q, $input, 'targets_'))
                ->pluck('id')->toArray();

            if (empty($usersId) || empty($targetsId)) {
                continue;
            }

            $discount = (float)$input['discount'];

            switch ($input['target_type']) {
                case 'brand':
                    $this->updateBrandsDiscount($usersId, $targetsId, $discount);
                    break;
                case 'category':
                    if ($discount) {
                        $this->updateCategoriesDiscount($usersId, $targetsId, $discount);
                    } else {
                        $this->clearCategoriesDiscount($usersId, $targetsId);
                    }
                    break;
                case 'group':
                    $this->updateGroupsDiscount($usersId, $targetsId, $discount);
                    break;
                case 'product':
                    $this->updateProductDiscounts($usersId, $targetsId, $discount);
                    break;
            }
        }
        return $errors ?? [];
    }

    protected function updateProductDiscounts(array $usersId, array $productsId, float $discount)
    {
        foreach ($usersId as $userId) {
            // Сохраняем discount по товарам
            $pack = collect($productsId)->map(function ($productId) use ($userId, $discount) {
                return [
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'discount' => $discount,
                ];
            })->toArray();

            DB::table('discount_product')
                ->upsert($pack, ['user_id', 'product_id'], ['discount']);
        }

        Product::query()
            ->whereIn('id', $productsId)
            ->chunk(500, function ($chunk) use ($usersId, $discount) {
                foreach ($usersId as $userId) {
                    $pack = $chunk->map(function ($product) use ($userId, $discount) {
                        return [
                            'user_id' => $userId,
                            'product_id' => $product->id,
                            'product' => $discount,
                            'retail' => $product->price_retail,
                            'wholesale' => $product->price_wholesale,
                        ];
                    })->toArray();

                    DB::table('product_user_price')
                        ->upsert($pack, ['user_id', 'product_id'], ['product', 'retail', 'wholesale']);
                }
            });
    }

    protected function updateBrandsDiscount(array $usersId, array $brandsId, float $discount)
    {
        foreach ($usersId as $userId) {
            // Сохраняем discount по брендам
            $pack = collect($brandsId)->map(function ($brandId) use ($userId, $discount) {
                return [
                    'user_id' => $userId,
                    'brand_id' => $brandId,
                    'discount' => $discount,
                ];
            })->toArray();

            DB::table('discount_brand')
                ->upsert($pack, ['user_id', 'brand_id'], ['discount']);
        }

        Product::query()
            ->whereHas('brand', fn($q) => $q->whereIn('id', $brandsId))
            ->select('price_retail', 'price_wholesale', 'id')->orderBy('id')->toBase()
            ->chunk(500, function ($chunk) use ($usersId, $discount) {
                foreach ($usersId as $userId) {
                    $pack = $chunk->map(function ($product) use ($userId, $discount) {
                        return [
                            'user_id' => $userId,
                            'product_id' => $product->id,
                            'brand' => $discount,
                            'retail' => $product->price_retail,
                            'wholesale' => $product->price_wholesale,
                        ];
                    })->toArray();

                    DB::table('product_user_price')
                        ->upsert($pack, ['user_id', 'product_id'], ['brand', 'retail', 'wholesale']);
                }
            });
    }

    protected function updateGroupsDiscount(array $usersId, array $groupsId, float $discount)
    {
        foreach ($usersId as $userId) {
            // Сохраняем discount по группам
            $pack = collect($groupsId)->map(function ($groupId) use ($userId, $discount) {
                return [
                    'user_id' => $userId,
                    'group_id' => $groupId,
                    'discount' => $discount,
                ];
            })->toArray();

            DB::table('discount_group')
                ->upsert($pack, ['user_id', 'group_id'], ['discount']);
        }

        Product::query()
            ->whereHas('groups', fn($q) => $q->whereIn('id', $groupsId))
            ->select('price_retail', 'wholesale', 'id')->orderBy('id')->toBase()
            ->chunk(500, function ($chunk) use ($usersId, $discount) {
                foreach ($usersId as $userId) {
                    $pack = $chunk->map(function ($product) use ($userId, $discount) {
                        return [
                            'user_id' => $userId,
                            'product_id' => $product->id,
                            'group' => $discount,
                            'retail' => $product->price_retail,
                            'wholesale' => $product->price_wholesale,
                        ];
                    })->toArray();

                    DB::table('product_user_price')
                        ->upsert($pack, ['user_id', 'product_id'], ['group', 'retail', 'wholesale']);
                }
            });
    }

    /**
     * Обновление скидок по выбранным категориям для выбранных пользователей
     *
     * @param array $usersId
     * @param array $categoriesId
     * @param float $discount
     * @return void
     */
    protected function updateCategoriesDiscount(array $usersId, array $categoriesId, float $discount)
    {
        // Получаем все категории потомки
        // Каждый элемент это массив ['id', 'parent_id', 'discount']
        $tree = $this->getCategoryDescendants($categoriesId, $usersId)->keyBy('id');

        // Отбираем все категории, включая их потомков, у которых уже есть персональная скидка
        $children = $tree->whereNotIn('id', $categoriesId);
        $hasDiscount = $signed = $children->filter->discount;
        do {
            $children = $children->whereNotIn('id', $signed->map->id);
            $signed = $children->whereIn('parent_id', $signed->map->id);
            $hasDiscount = $hasDiscount->merge($signed);
        } while ($signed->isNotEmpty());

        // Получаем все категории которые будут применять discount
        $alive = $tree->diffKeys($hasDiscount);

        // --- Сохраняем значения скидок по категориям в промежуточной таблице для каждого пользователя
        foreach ($usersId as $userId) {
            // По рабочим категориям
            $pack = collect($categoriesId)->map(function ($catId) use ($userId, $discount) {
                return [
                    'user_id' => $userId,
                    'category_id' => $catId,
                    'discount' => $discount,
                ];
            })->toArray();

            DB::table('discount_category')
                ->upsert($pack, ['user_id', 'category_id'], ['discount']);
        }
        // ---


        // --- Обноляем скидки по товарам для каждого пользователя
        Product::query()
            ->whereHas('categories', fn($q) => $q->whereIn('id', $alive->map->id))
            ->whereDoesntHave('categories', fn($q) => $q->whereIn('id', $hasDiscount->map->id))
            ->select('price_retail', 'wholesale', 'id')->orderBy('id')->toBase()
            ->chunk(500, function ($chunk) use ($usersId, $discount) {
                foreach ($usersId as $userId) {
                    $pack = $chunk->map(function ($product) use ($userId, $discount) {
                        return [
                            'user_id' => $userId,
                            'product_id' => $product->id,
                            'category' => $discount,
                            'retail' => $product->price_retail,
                            'wholesale' => $product->price_wholesale,
                        ];
                    })->toArray();

                    DB::table('product_user_price')
                        ->upsert($pack, ['user_id', 'product_id'], ['category', 'retail', 'wholesale']);
                }
            });
    }

    /**
     * Очистка скидок по выбранным категориям для выбранных пользователей
     *
     * @param array $usersId
     * @param array $categoriesId
     * @return void
     */
    protected function clearCategoriesDiscount(array $usersId, array $categoriesId)
    {
        foreach ($usersId as $userId) {
            // По рабочим категориям стираем discount
            $pack = collect($categoriesId)->map(function ($catId) use ($userId) {
                return [
                    'user_id' => $userId,
                    'category_id' => $catId,
                    'discount' => 0,
                ];
            })->toArray();

            DB::table('discount_category')
                ->upsert($pack, ['user_id', 'category_id'], ['discount']);

            $categories = Category::query()->whereIn('id', $categoriesId)->get();

            // Получаем всех родителей с их персональными скидками
            $parents = $categories;
            $allParents = collect([]);
            do {
                $parents = Category::query()
                    ->whereIn('id', $parents->map->parent_id)
                    ->leftJoin('discount_category as pc', function ($j) use ($usersId) {
                        $j->on('pc.category_id', 'categories.id')
                            ->where('pc.user_id', $usersId);
                    })
                    ->select(['id', 'parent_id', 'pc.discount'])
                    ->toBase()
                    ->get()
                    ->map(fn($r) => get_object_vars($r));

                $allParents = $allParents->merge($parents);
                // Исключаем из дальнейшего поиска родителей с персональной скидкой.
                $parents = $parents->reject->discount;
            } while ($parents->isNotEmpty());

            // Поиск ближайшего родителя с установленной скидкой
            $toUpdate = $categories->map(function ($cat) use ($allParents) {
                $parentId = $cat->parent_id;
                do {
                    $parent = $allParents->firstWhere('id', $parentId);
                    $parentId = $parent['parent_id'] ?? 0;
                } while ($parent && !$parent['discount']);

                return [
                    'id' => $parent['id'] ?? $cat->id,
                    'discount' => $parent['discount'] ?? 0,
                    'group' => (string)($parent['discount'] ?? 0),
                ];
            });

            // Группировка категорий по скидкам, для уменьшения вызовов
            // и запуск обновления
            $toUpdate->groupBy('group')
                ->each(function ($group) use ($userId) {
                    $discount = $group->map->discount->first();
                    $cats = $group->pluck('id')->toArray();
                    $this->updateCategoriesDiscount([$userId], $cats, $discount);
                });
        }
    }

    /**
     * Получает линейный список всех id дочерних категорий любой глубины.
     * В ответ включен параметр персональной скидки для каждой категории.
     *
     * @param array $parentsId
     * @param array $usersId
     * @return Collection    // Collection of ['id', 'parent_id', 'discount']
     */
    protected function getCategoryDescendants(array $parentsId, array $usersId): Collection
    {
        if (empty($parentsId)) {
            return collect([]);
        }

        $response = $children = collect($parentsId)
            ->map(fn($id) => ['id' => $id, 'parent_id' => 0, 'discount' => 0]);
        while ($children->isNotEmpty()) {
            $children = Category::query()
                ->whereIn('parent_id', $children->map->id)
                ->leftJoin('discount_category as pc', function ($j) use ($usersId) {
                    $j->on('pc.category_id', 'categories.id')
                        ->where('pc.user_id', $usersId);
                })
                ->select(['id', 'parent_id', 'pc.discount'])
                ->toBase()
                ->get()
                ->map(fn($r) => get_object_vars($r));
            $response = $response->merge($children);
        }

        return $response;
    }


}
