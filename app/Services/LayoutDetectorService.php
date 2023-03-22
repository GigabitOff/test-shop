<?php
/**
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
 * Date: 22.03.2023
 * Time: 07:57
 */

namespace App\Services;


use App\Models\Product;
use App\Models\Review;

class LayoutDetectorService
{
    const ATTRIBUTES_VISIBLE = 1;
    const VARIATIONS_VISIBLE = 2;
    const DESCRIPTION_VISIBLE = 4;
    const ACCOMPANYING_VISIBLE = 8;

    // The variant is a combination of visible blocks
    const MODE_1 = self::ATTRIBUTES_VISIBLE ^ self::VARIATIONS_VISIBLE ^ self::DESCRIPTION_VISIBLE ^ self::ACCOMPANYING_VISIBLE;
    const MODE_2 = self::ATTRIBUTES_VISIBLE ^ self::DESCRIPTION_VISIBLE ^ self::ACCOMPANYING_VISIBLE;
    const MODE_3 = self::VARIATIONS_VISIBLE ^ self::DESCRIPTION_VISIBLE ^ self::ACCOMPANYING_VISIBLE;
    const MODE_4 = self::DESCRIPTION_VISIBLE ^ self::ACCOMPANYING_VISIBLE;
    const MODE_5 = self::ATTRIBUTES_VISIBLE ^ self::VARIATIONS_VISIBLE ^ self::DESCRIPTION_VISIBLE;
    const MODE_6 = self::VARIATIONS_VISIBLE ^ self::DESCRIPTION_VISIBLE;
    const MODE_7 = self::ATTRIBUTES_VISIBLE ^ self::VARIATIONS_VISIBLE ^ self::ACCOMPANYING_VISIBLE;
    const MODE_8 = self::ATTRIBUTES_VISIBLE ^ self::DESCRIPTION_VISIBLE;
    const MODE_9 = self::DESCRIPTION_VISIBLE;

    /**
     * Check blocks visibility and generate an appropriate mode
     *
     * @param Product $product
     * @return int
     */
    public function detectMode(Product $product): int
    {
        $mode = 0;

        $mode ^= !empty($product->vars_attrs) && !empty($product->vars_key) ? self::VARIATIONS_VISIBLE : 0;
        $mode ^= !empty($product->attributeValues->count()) ? self::ATTRIBUTES_VISIBLE : 0;
        $mode ^= !empty($product->technical_description) ? self::DESCRIPTION_VISIBLE : 0;
        $mode ^= !empty($product->accompanying->count()) ? self::ACCOMPANYING_VISIBLE : 0;
        $mode ^= !empty(Review::where(
            [
                'product_id' => $product->id ?? 0,
                'status'     => 1,
            ])
            ->count()
        ) ? self::REVIEWS_VISIBLE : 0;

        return $mode;
    }

    public function countColumns($mode): int
    {
        if (in_array($mode, [
            self::MODE_2,
            self::MODE_3,
            self::MODE_4,
            self::MODE_8,
            self::MODE_9,
        ])) {
            return 3;
        }

        return 2;
    }
}
