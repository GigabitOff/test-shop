<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryService
{

    protected array $categoryIdsWithChildren = [];


    /**
     * Получает линейный список всех id дочерних категорий любой глубины.
     *
     * @param array|int $parentIds
     * @return array
     */
    public function getCategoryIdsWithChildren($parentIds, $force = false): array
    {
        if (empty($parentIds)) {
            return [];
        }

        $hash = $this->makeHash((array)$parentIds);
        $categoryIds = $this->categoryIdsWithChildren[$hash] ?? false;
        if (false === $categoryIds || $force ) {
            $categoryIds = $children = (array)$parentIds;
            while ($children) {
                $children = Category::query()->whereIn('parent_id', $children)->pluck('id')->toArray();
                $categoryIds = array_merge($categoryIds, $children);
            }

            $this->categoryIdsWithChildren[$hash] = $categoryIds;
        }

        return $categoryIds ?: [];
    }

    /**
     * Собирает массив родительских категорий.
     * Последовательность от потомка к корню.
     * Отсортированы от потомка к корню.
     *
     * @param Category $child
     * @param bool $withCurrent   Включать в результат исходную категорию
     * @return EloquentCollection
     */
    public function getCategoryParents(Category $child, bool $withCurrent = true): EloquentCollection
    {
        $collection = resolve(EloquentCollection::class);

        if ($withCurrent){
            $collection->push($child);
        }

        $category = $child;
        while ($category->parent_id){
            if ($parent = $category->parent) {
                $collection->push($parent);
                $category = $parent;
            } else {
                break;
            }
        }

        return $collection->reverse();
    }

    private function makeHash(array $payload): string
    {
        return md5(json_encode($payload));
    }

    /**
     * Формирует готовый массив данных для хлебных крошек.
     *
     * Выходной массив имеет формат [ ['url'=>'', 'name'=>''], ... ]
     *
     * @param Category|null $category
     * @param bool $withCurrent   Включать в результат исходную категорию
     * @return EloquentCollection|Collection
     */
    public function makeCatalogBreadcrumbsList(?Category $category, bool $withCurrent = false)
    {
        $list = $category
            ? $this
                ->getCategoryParents($category, $withCurrent)
                ->load('translations')
                ->each(fn(Category $cat) => $cat->routeLink = route('catalog.show', $cat->slug))
                ->map(function (Category $cat) {
                    return [
                        'url' => $cat->routeLink,
                        'name' => $cat->name,
                    ];
                })
            : collect([]);

        $list->prepend([
            'url' => route('catalog.index'),
            'name' => __('custom::site.catalog'),
        ]);

        return $list;
    }

    /**
     * Получает список предков отсортированных по deep.
     *
     * Внимание!
     * Если в исходных данных есть категории состоящие в отношении предок => потомок, тогда в результате
     * будут присутствовать дубликаты отношений id => parent_id по одному для каждой искомой категории.
     *
     * @param int[] $categories
     * @return \Illuminate\Support\Collection // as StdObject (id, parent_id, deep, starter, [deep_line])
     */
    public function getAncestors(array $categories, bool $deepLine = false): \Illuminate\Support\Collection
    {
        if (!$categories){
            return collect([]);
        }

        $injection = implode(',', $categories);

        $dlFirst = $deepLine ? ', CAST(t1.id AS CHAR(65535)) AS deep_line' : '';
        $dlSecond = $deepLine ? ', CONCAT(t2.deep_line, \'|\', CAST(t3.id AS CHAR(65535)))' : '';

        $rawSql = <<<SQL
            WITH RECURSIVE cte  AS (
                    SELECT t1.id, t1.parent_id, 1 as deep, t1.id as starter {$dlFirst}
                    FROM categories t1
                    WHERE t1.id IN ({$injection})
                    UNION ALL
                    SELECT t3.id, t3.parent_id, (t2.deep + 1) AS deep, t2.starter {$dlSecond}
                    FROM categories t3, cte t2
                    WHERE t3.id = t2.parent_id
                )
            SELECT *
            FROM cte
            WHERE 1
            ORDER BY deep DESC;
        SQL;

        return collect(DB::select($rawSql));
    }


}
