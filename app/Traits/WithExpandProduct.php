<?php

namespace App\Traits;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

/**
 * Дополнительные функции расширяюшие данные товара
 */
trait WithExpandProduct
{

    /**
     * Расширение доступности товара
     * Используется для отображения ярлычка в карточках товара
     *
     * @param  Product  $product
     * @param  User|null  $user
     * @return void
     */
    protected function expandProductAvailability(Product $product, ?User $user = null): void
    {
        $user = $user ?: auth()->user();
        $legal = $user->is_customer_legal ?? false;

        $css = '';
        if ($product->on_backorder) {
            $text = __('custom::site.on_backorder');
            $css = 'for-order';
        } else {
            if ($legal && $product->show_stock) {
                if ($product->stock > 0) {
                    $text = "{$product->stock} {$product->measure}";
                } else {
                    $text = __('custom::site.availability_absent');
                    $css = 'not';
                }
            } else {
                switch ($product->availability) {
                    case Product::AVAILABILITY_IN_STOCK:
                        $text = __('custom::site.availability_exist');
                        break;
                    case Product::AVAILABILITY_SMALL_STOCK:
                        $text = __('custom::site.availability_small');
                        break;
                    case Product::AVAILABILITY_OUT_OF_STOCK:
                    default:
                        $text = __('custom::site.availability_absent');
                        $css = 'not';
                }
            }
        }

        $product->availabilityText = $text;
        $product->availabilityCss = $css;
    }

    /**
     * Подготавливает url картинки товара для шаблона
     *
     * @param  Product  $product
     * @return void
     */
    protected function expandProductMainImageUrl(Product $product)
    {
        $product->mainImageUrl = fallbackProductImageUrl($product->imagefullUrl);
    }

    /**
     * Подготавливает url картинки бренда для шаблона
     *
     * @param  Product  $product
     * @return void
     */
    protected function expandProductBrandImageUrl(Product $product)
    {
        $product->brandImageUrl = $product->brand->imageFullUrl ?? '';
    }

    /**
     * Подготавливает данные по категории
     *
     * @param  Product  $product
     * @param  Category|null  $category
     * @return void
     */
    protected function expandProductCategory(Product $product, ?Category $category = null)
    {
        $category = $category ?? $product->categories->first();
        $product->categoryName = $category->name ?? '';
    }

    /**
     * Выбирает разновидности с унакальными валидными расцветками
     * @param  Product  $product
     * @return void
     */
    public function expandProductUniqColorVariations(Product $product)
    {
        $canShow = in_array('color', $product->vars_attrs ?? [], true);
        $product->colorVariations = $canShow
            ? $product->allVariations
                ->filter(fn($el) => isColorCodeValid($el->color))
                ->unique->color
            : collect();
    }

    /**
     * Выбирает разновидности с унакальным атрибутом отображаемым в карточке
     * @param  Product  $product
     * @return void
     */
    public function expandProductUniqCardAttributeVariations(Product $product)
    {
        $attr = $product->card_attribute;
        $canShow = $attr && in_array($attr, $product->vars_attrs ?? []);

        $attrValues = is_numeric($attr)
            ? AttributeValue::query()
                ->withTranslation()
                ->where('attribute_id', $attr)
                ->whereIn('product_id', $product->allVariations->pluck('id'))
                ->get()
            : collect();

        $product->cardAttrVariations = $canShow
            ? $product->allVariations
                ->each(function (Product $el) use ($attr, $attrValues) {
                    $attrValue = $attrValues->firstWhere('product_id', $el->id);
                    $el->cardAttrValue = is_numeric($attr)
                        ? ($attrValue->name ?? '')
                        : $el->{$attr};
                })
                ->filter->cardAttrValue
                ->unique->cardAttrValue
            : collect();
    }

}
