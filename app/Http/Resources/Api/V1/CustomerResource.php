<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_site' => $this->id,
            'id_1c' => $this->id_1c,
            'fio' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'login' => $this->login,
            'clienttype' => (int)$this->hasRole('legal'), //юрлицо -1, физлицо-0
            'is_admin' => $this->is_admin,
            'birth_date' => $this->birth_date ?? '',
            'position' => $this->position ?? '',
            'is_active' => (bool) $this->is_active,
            'counterparty_ids_1c' => $this->getCounterpartyIds1cLine(),
            'counterparty_ids_site' => $this->getCounterpartyIdsSiteLine(),
            'delivery_address_ids_site' => $this->getDeliveryAddressesLine(),    //", # сайтовый идентификатор адреса из справочника доставки (через запятую, если несколько значений)
            'updated_at' => $this->updated_at,
        ];
    }

    private function getDeliveryAddressesLine()
    {
        return $this->deliveryAddresses->map->id->join(',');
    }

    private function getCounterpartyIds1cLine()
    {
        return $this->counterparties->map->id_1c->join(',');
    }

    private function getCounterpartyIdsSiteLine()
    {
        return $this->counterparties->map->id->join(',');
    }

}
