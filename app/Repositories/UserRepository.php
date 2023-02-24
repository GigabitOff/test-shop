<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Прикрепляет новые котракты к пользователю
     * @param User $customer
     * @param $contract_ids
     * @return void
     */
    public static function appendCustomerContracts(User $customer, $contract_ids = [])
    {
        $customer->contracts()->syncWithoutDetaching($contract_ids);
    }

    /**
     * Открепляет контракты от пользователя
     * @param User $customer
     * @param $contract_ids
     * @return void
     */
    public static function removeCustomerContracts(User $customer, $contract_ids = [])
    {
        foreach ($contract_ids as $contract_id) {
            //todo: отправить сообщение что пользователь удален из этих контрактов
            // только у менеджера, когда он промодерирует изменения
            // возможно потребуется пререключение привязки заказов.
        }

        $customer->contracts()->detach($contract_ids);
    }

    /**
     * Устанавливает новые контракты для пользователя
     * @param User $customer
     * @param $contract_ids
     * @return void
     */
    public static function syncCustomerContracts(User $customer, $contract_ids = [])
    {
        $prev = $customer->contractIds->toArray();
        $to_remove = array_diff($prev, $contract_ids);
        $to_append = array_diff($contract_ids, $prev);

        self::removeCustomerContracts($customer, $to_remove);
        self::appendCustomerContracts($customer, $to_append);
    }

    /**
     * Получает покупателя по ID
     * @param int $id
     * @param bool $withTrashed
     * @return User|null
     */
    public static function getCustomerById($id, $withTrashed = false): ?User
    {
        $query = User::whereId($id ?? 0)->role('customer');
        if ($withTrashed){
            $query->withTrashed();
        }

        return $query->first();
    }
}
