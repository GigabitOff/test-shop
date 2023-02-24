<?php

namespace App\Repositories;

use App\Models\Contract;
use App\Models\Counterparty;
use App\Models\PaymentType;
use App\Models\PriceType;
use App\Models\Product;
use App\Models\User;

class PriceRepository
{
    static array $cachePrices = [];

    static ?User $customer = null;
    static ?Contract $counterparty = null;
    static bool $paymentCash = false;

    static Product $product;

    /**
     * Get actual price with calculated discount if that need
     *
     * @param Product $product
     * @param User|null $customer
     * @param Counterparty|null $counterparty
     * @param PaymentType|null $paymentType
     * @return float|int|mixed
     */

    public static function prices(
        Product $product,
        ?User $customer = null,
        ?Counterparty $counterparty = null,
        ?PaymentType $paymentType = null
    ) {
        self::$product = $product;
        self::$customer = $customer ?? auth()->user();
        self::$counterparty = $counterparty;

        if ($paymentType) {
            self::$paymentCash = $paymentType->isCash();
        } elseif (self::$customer) {
            if (self::$customer->paymentType) {
                self::$paymentCash = self::$customer->paymentType->isCash();
            } else {
                self::$paymentCash = (self::$customer->defaultPaymentType === PaymentType::CASH);
            }
        }

        $hash = self::getHash();
        if (empty(self::$cachePrices[$hash])) {
            self::$cachePrices[$hash] = self::$customer
                ? self::authUserPrice()
                : self::productPriceInit();
        }

        return self::$cachePrices[$hash];
    }

    /**
     * Get original product price
     *
     * @return float
     */
    private static function productPriceInit(): float
    {
        return self::$product->price_init;
    }

    /**
     * Calculate hash
     *
     * @return string
     */
    private static function getHash(): string
    {
        return sprintf(
            '%s|%s|%s|%s',
            self::$product->id,
            self::$customer->id ?? 0,
            self::$counterparty->id ?? 0,
            (int)self::$paymentCash
        );
    }

    /**
     *  Get prices for auth user
     *
     * @return float|int|mixed
     */

    private static function authUserPrice()
    {
//        switch (true) {
//            case self::$customer->isCustomerLegal:
//                return self::priceCustomerLegal();
//            case self::$customer->isCustomerSimple:
//                // ToDo: Проверить расчет скидки для обычного клиента.
//                return self::priceCustomerSimple();
//        }

        return self::$customer->isCustomerLegal
            ? self::priceCustomerLegal()
            : self::productPriceInit();
    }

    /**
     *  Get price if user is customer legal
     */
    private static function priceCustomerLegal()
    {
        $priceType =
            self::personalPriceType() ??
            self::counterpartyPriceType();

        return self::productPriceInit() * ($priceType ? $priceType->discountMultiplier : 1);
    }

    /**
     * Get priceType for contract
     *
     * @return PriceType|null
     */
    private static function counterpartyPriceType(): ?PriceType
    {
        return self::$counterparty
            ? self::$counterparty->priceTypes()
                ->wherePivot('cashless', !self::$paymentCash)
                ->first()

            : null;
    }

    /**
     * Определение скидки (тип цены) по номенклатурным скидкам
     *
     * @return PriceType|null
     */
    private static function personalPriceType(): ?PriceType
    {
        return
            self::personalGroupPriceType() ??
            self::personalProductPriceType();
    }

    /**
     * Определяем персональный для контрагента тип цены по товару
     *
     * @return PriceType|null
     */
    private static function personalProductPriceType(): ?PriceType
    {
        return self::$counterparty
            ? PriceType::query()
                ->whereHas('productsByCounterparty', function ($q) {
                    $q->where('counterparty_id', self::$counterparty->counterparty_id)
                        ->where('product_id', self::$product->id)
                        ->where(function ($q) {
                            $q->where('date_end', '>=', now())
                                ->orWhereNull('date_end');
                        });
                })
                ->first()
            : null;
    }

    /**
     * Определяем персональный для контрагента тип цены по группе товаров
     *
     * @return PriceType|null
     */
    private static function personalGroupPriceType(): ?PriceType
    {
        return self::$counterparty
            ? PriceType::query()
                ->whereHas('productGroupsByCounterparty', function ($q) {
                    $q->where('counterparty_id', self::$counterparty->counterparty_id);
                    $q->where(function ($q) {
                        $q->where('date_end', '>=', now())
                            ->orWhereNull('date_end');
                    });
                    $q->whereHas('products', function ($q2) {
                        $q2->where($q2->getModel()->getTable() . '.id', self::$product->id);
                    });
                })
                ->first()
            : null;
    }

    /**
     *  Get prices if user not customer legal
     */

    private static function priceCustomerSimple()
    {
        $productId = self::$product->id;

        $productPrice = Product::with('priceTypes')->with('groups.translations')
            ->where('id', '=', $productId)->get(['id', 'price_init'])->toArray();

        return self::calculateDiscountPrices($productPrice);
    }

    /**
     *  calculate prices with discount
     *
     * @return float|int|mixed
     */
    private static function calculateDiscountPrices($productPrice)
    {
        foreach ($productPrice as $product) {
            // пока groups вынесен в исключения по расчету скидок

            if (!isset($product['groups'])) {
                if (!empty($product['priceTypes'])) {
                    $product['price_init'] = $product['price_init'] -
                        ($product['price_init'] * $product['priceTypes'][0]['percent'] / 100);
                }
            }
            $prices = $product['price_init'];
        }
        return $prices;
    }
}
