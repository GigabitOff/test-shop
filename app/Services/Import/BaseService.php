<?php

namespace App\Services\Import;

use App\Contracts\ImagesOwnerContract;
use App\Services\UploadImagesService;
use Astrotomic\Translatable\Locales;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function app;
use function collect;

class BaseService
{
    protected array $locales = [];

    public function __construct(Locales $locales)
    {
        //For imports make available all languages

//        $languages = Language::query()->pluck('lang')->toArray();
//        foreach ($languages as $language) {
//            if (!in_array($language, $locales->all())) {
//                $locales->add($language);
//            }
//        }

        $this->locales = $locales->all();
    }

    /**
     * Поиск модели по id_site или id_1c
     * Не вынесено в класс модели для мобильности API.
     */
    protected function findModelScope(Builder $query, array $input, string $prefix = ''): Builder
    {
        $idSite = $input["{$prefix}id_site"] ?? 0;
        $id1c = $input["{$prefix}id_1c"] ?? '';

        return $query
            ->where('id', (int)$idSite)
            ->when($id1c, fn($q) => $q->orWhere('id_1c', $id1c));
    }

    /**
     * Выборка моделей по id_site или id_1c
     * Не вынесено в класс модели для мобильности API.
     */
    protected function whereInModelScope(Builder $query, array $input, string $prefix = ''): Builder
    {
        $idsSite = $this->explodeLine($input["{$prefix}id_site"] ?? '');
        $ids1c = $this->explodeLine($input["{$prefix}id_1c"] ?? '');

        return $query
            ->where(function($q) use($idsSite, $ids1c){
                $q->when($idsSite, fn($q1) => $q1->orWhereIn('id', $idsSite));
                $q->when($ids1c, fn($q1) => $q1->orWhereIn('id_1c', $ids1c));
            });
    }

    /**
     * Валидация
     * @param array $input
     * @param array $rules
     * @param array $keys Ключи используемые в правилах
     * @return array|false
     */
    protected function validate(array $input, array $rules, array $keys = [])
    {
        $keys = $keys ?: array_keys($rules);
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return [
                'message' => 'not imported',
                'data' => $input,
                'errors' => $validator->errors()->messages(),
            ];
        }

        return false;
    }

    /**
     * Очищает пустое правило по фактору наличия второго правила
     * Также запрещает очистку обоих правил.
     * Используется для проверки хотя бы одного правила.
     * также утверждает проверку обоих если они заполнены.
     * Пример заполнения правил:
     *    'order_id_site' => 'required_without:order_id_1c|exists:orders,id',
     *    'order_id_1c' => 'required_without:order_id_site|exists:orders,id_1c',
     *
     * @param array $item
     * @param array $rules
     * @param string $param1
     * @param string $param2
     * @return array
     */
    protected function restrictIdRules(array $item, array $rules, string $param1, string $param2): array
    {
        if (empty($item[$param1]) && !empty($item[$param2])) {
            unset($rules[$param1]);
        }
        if (empty($item[$param2]) && !empty($item[$param1])) {
            unset($rules[$param2]);
        }

        return $rules;
    }

    /**
     * Переводит все значения массива в слаги
     * @param array $values
     * @return array
     */
    protected function sluggableArrayValues(array $values): array
    {
        foreach ($values as $key => $value) {
            $slugs[$key] = Str::slug($value);
        }

        return $slugs ?? [];
    }

    /**
     * Привязка переводов к модели с проверкой на пустоту.
     *
     * @param Model $model Объект модели с подключенным трейтом переводов
     * @param string $field Название поля которое надо заполнить
     * @param array $values Ассоциативный массив переводов с ключами - кодами локали.
     */
    protected function bindLangValues(Model $model, string $field, array $values)
    {
        foreach ($this->locales as $locale) {
            if (!empty($values[$locale])) {
                $model->translateOrNew($locale)->{$field} = $values[$locale] ?? '';
            }
        }
    }

    /**
     * Разбивка строки с очисткой.
     *
     * @param string $line
     * @param string $separator
     * @return string[]
     */
    protected function explodeLine(string $line, string $separator = ','): array
    {
        return array_filter(array_map('trim', explode($separator, $line ?? '')));
    }

    /**
     * Парсинг строки с датой
     *
     * @param string|null $date
     * @param null $default
     * @return false|string|null
     */
    public function parseDate(?string $date, $default = null)
    {
        return ($valid_date = strtotime($date ?? ''))
            ? date('Y-m-d H:i:s', $valid_date)
            : $default;
    }

    /**
     * Нормализует значения параметров сортировки
     * @param Model $model
     * @param string $orderField
     * @param string $parentField
     * @return void
     */
    protected function normalizeModelSortOrder(Model $model, string $orderField, string $parentField = '')
    {
        $items = $model->newQuery()
            ->when($parentField, fn($q) => $q->where($parentField, $model->{$parentField}))
            ->orderBy($orderField)
            ->pluck($orderField, 'id')
            ->toArray();

        $newOrder = 1;
        foreach ($items as $id => $sortOrder) {
            if ($newOrder === $model->{$orderField}) {
                $newOrder++;
            }

            if ($id !== $model->id) {
                $items[$id] = $newOrder;
                $newOrder++;
            }
        }

        $items[$model->id] = ($model->{$orderField} > 0)
            ? min($newOrder, $model->{$orderField})
            : $newOrder;

        $this->bulkUpdate($model->getTable(), $orderField, $items);
    }

    /**
     * Массовое обновление
     *
     * @url https://dev.to/kodeas/bulk-update-multiple-records-with-separate-data-laravel-4j7k
     *
     * @param string $table
     * @param string $column
     * @param array $data
     * @return void
     */
    protected function bulkUpdate(string $table, string $column, array $data)
    {
        foreach ($data as $id => $value) {
            $cases[] = "WHEN {$id} then ?";
            $params[] = $value;
            $ids[] = $id;
        }

        $ids = implode(',', $ids ?? []);
        $cases = implode(' ', $cases ?? []);
        $params = $params ?? [];

        if (!empty($ids)) {
            DB::update("UPDATE {$table} SET `{$column}` = CASE `id` {$cases} END WHERE `id` in ({$ids})", $params);
        }
    }

    /**
     * Upload model Images from urls coma separated string
     *
     * @param ImagesOwnerContract $model
     * @param array|null $urls
     * @param bool $main
     * @return void
     */
    protected function uploadModelImages(ImagesOwnerContract $model, ?array $urls, bool $main)
    {
        if ($urls) {
            try {
                app(UploadImagesService::class)
                    ->uploadImages($model, $urls, $main);
            } catch (\Exception $e) {
            }
        }
    }

}
