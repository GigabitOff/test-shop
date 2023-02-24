<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class CounterpartyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_site' => $this->id,
            'id_1c' => $this->id_1c,
//            'parent_id_1c' => $this->parent_id_1c,
            'okpo' => $this->okpo,
            'town' => $this->city ? $this->city->koatuu : '',
            'customer_ids_site' => $this->getUsersLine(),   // #/к какому пользователю принадлежит/
            'intermediate_counterparty_okpo' => $this->getCounterpartiesOkpoLine(),     //", #OKPO всех смежных контрагентов, без учета головного
            'manager_id' => $this->manager_id,     // #Менеджер (ID Справочник менеджер)
            'region_manager_id' => $this->region_manager_id,  // #Менеджер региона (ID Справочник менеджер)
            'phone' => $this->phone,  // # телефон
            'delivery_address_ids_site' => $this->getDeliveryAddressesLine(),    //", # сайтовый идентификатор адреса из справочника доставки (через запятую, если несколько значений)
            'company_name' => $this->name,   //  # физ.лица входят в этот запрос, для физ. лиц пустое значение
            'nds' => (int)$this->is_nds,    //плательщик НДС, значения 0/1
            'typepayment' => $this->is_payment_cash ? 'nal' : 'beznal',    // #тип оплаты по умолчанию - нал/безнал , значение nal/beznal
            'bonus' => (int)$this->is_can_bonus,  // # Бонус (вкл выкл ), значение 0/1
            'updated_at' => $this->updated_at,
        ];
    }

    private function getDeliveryAddressesLine()
    {
        return $this->deliveryAddresses->map->id->join(',');
    }

    private function getUsersLine()
    {
        return $this->users->map->id->join(',');
    }

    private function getCounterpartiesOkpoLine()
    {
        return $this->siblings->map->okpo->filter()->join(',');
    }
}
