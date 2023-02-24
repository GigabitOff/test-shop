<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Не смог правильно использовать $this->mergeWhen (почему то вывод был как вложенный массив)
        // поэтому вывел через merge_array.
        return array_merge([
                'id_site' => $this->id,
                'total' => $this->total , // сумма заказа
                'total_quantity' => $this->total_quantity, // количество товаров
                'type_payment' => $this->type_payment, //тип оплаты, значения - "nal" или "beznal"
                'date_registration' =>  $this->created_at, // дата создания заказа
                'date_delivery' => $this->date_delivery ?? '', // плановая дата отгрузки из 1С
                'status_id_1c' => $this->status->id_1c ?? '', // id статуса заказа
                'order_products' => OrderProductResource::collection($this->products),
                'updated_at' => $this->updated_at,
            ],
            $this->normalOrderFields(),
            $this->fastOrderFields()
        );
    }

    private function getCounterpartyId1c(): string
    {
        return $this->counterparty ? $this->counterparty->id_1c : '';
    }

    private function fastOrderFields(): array
    {
        // Выводим если это быстрый заказ.
        return $this->fast_order
            ? [
                'phone' => $this->phone,
                'name' => $this->fio,
                'email' => null,
                'company_name' => $this->company,
            ]
            : [];
    }

    private function normalOrderFields(): array
    {
        // Выводим если это обычный заказ.
        return ! $this->fast_order
            ? [
                'id_1c' => $this->id_1c,
                'counterparty_id_site' => $this->counterparty_id,
                'counterparty_id_1c' => $this->getCounterpartyId1c(),
                'driver_id_1c' => $this->driver->id_1c ?? '', // id водителя из справочника
                'manager_id_1c' => $this->manager->id_1c ?? '', // id менеджера из справочника
                'delivery_address_id_site' => $this->delivery_address->id ?? '', // сайтовый идентификатор адреса из справочника доставки
                'delivery_address_id_1c' => $this->delivery_address->id_1c ?? '', // 1С идентификатор адреса из справочника
                'customer_id_site' => $this->customer_id,
//                'cashback_used' => $this->cashback_used,
//                'cashback_earned' => $this->cashback_earned,
//                'bonus_used' => $this->bonus_used,
//                'bonus_earned' => $this->bonus_earned,
            ]
            : [];
    }
}
