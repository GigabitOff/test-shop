<?php

namespace App\Services;

use App\Enums\BonusType;
use App\Models\BonusTransaction;
use App\Models\User;

class BonusService
{

    /**
     * Начисление бонусов. Используется при получении заказа покупателем.
     * @param int $customerId
     * @param int $orderId
     * @param float $value
     * @return void
     */
    public function accumulateBonus(int $customerId, int $orderId, float $value)
    {
        if (!$value || !$customer = User::find($customerId)) {
            throw new \InvalidArgumentException();
        }

        $this->addAccumulatedTransaction(
            $customer,
            abs($value),
            "Резервирование бонусов по заказу: {$orderId}"
        );
    }

    /**
     * Перевод бонусов в режим доступных. Используется при истечении 14 дней с момента покупки.
     * @param int $customerId
     * @param int $orderId
     * @param float $value
     * @return void
     */
    public function makeAvailableBonus(int $customerId, int $orderId, float $value)
    {
        if (!$value || !$customer = User::find($customerId)) {
            throw new \InvalidArgumentException();
        }

        $this->addAccumulatedTransaction(
            $customer,
            abs($value) * (-1),
            "Перевод бонуса в 'Доступный' по заказу: {$orderId}"
        );

        $this->addAvailableTransaction(
            $customer,
            abs($value),
            "Начисление бонусов по заказу: {$orderId}"
        );
    }

    /**
     * Расходование бонусов. Используется при оформлении заказа.
     * @param int $customerId
     * @param int $orderId
     * @param float $value
     * @return void
     */
    public function expenseBonus(int $customerId, int $orderId, float $value)
    {
        if (!$value || !$customer = User::find($customerId)) {
            throw new \InvalidArgumentException();
        }

        $this->addAvailableTransaction(
            $customer,
            abs($value) * (-1),
            "Списание бонусов по заказу: {$orderId}"
        );
    }

    /**
     * Отмена списания бонусов. Использвется при переоформлении заказа.
     * @param int $customerId
     * @param int $orderId
     * @param float $value
     * @return void
     */
    public function discardBonus(int $customerId, int $orderId, float $value)
    {
        if (!$value || !$customer = User::find($customerId)) {
            throw new \InvalidArgumentException();
        }

        $this->addAvailableTransaction(
            $customer,
            abs($value),
            "Восстановление бонусов по заказу: {$orderId}"
        );
    }

    private function addAvailableTransaction(User $customer, float $value, string $comment)
    {
        BonusTransaction::create([
            'customer_id' => $customer->id,
            'balance_before' => $customer->bonus_available,
            'transaction_value' => $value,
            'balance_after' => $customer->bonus_available + $value,
            'type' => BonusType::Available,
            'comment' => $comment,
        ]);

        $customer->bonus_available += $value;
        $customer->save();
    }

    private function addAccumulatedTransaction(User $customer, float $value, string $comment)
    {
        BonusTransaction::create([
            'customer_id' => $customer->id,
            'balance_before' => $customer->bonus_accumulated,
            'transaction_value' => $value,
            'balance_after' => $customer->bonus_accumulated + $value,
            'type' => BonusType::Accumulated,
            'comment' => $comment,
        ]);

        $customer->bonus_accumulated += $value;
        $customer->save();
    }

    /**
     * @return float
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function calculateCartCheckedMaxBonusToUse()
    {
        return cart()->checkedProducts()
            ->map(function($product) {
                $bonus = $product->price > 0.06
                    ? $product->price - 0.06
                    : 0;
                return $bonus * $product->cartQuantity;
            })->sum();

    }

    /**
     * @return float
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function calculateCartCheckedMaxBonusEarned()
    {
        // ToDo: Нужен метод расчета заработанных бонусов
        return 0;
    }

}
