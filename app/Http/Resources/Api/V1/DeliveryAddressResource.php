<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Contract;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryAddressResource extends JsonResource
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
            'id_1c' => $this->id_1c,
            'id_site' => $this->id,
            'owner' => [
                'id_1c' => $this->owner ? $this->owner->id_1c : null,
                'id_site' => $this->owner? $this->owner->id : null,
                'is_counterparty' => ($this->owner instanceof Contract),
            ],
            'delivery_type_id_1c' => $this->deliveryType ? $this->deliveryType->id_1c : null,
            'city_code' => $this->city ? $this->city->koatuu : null,
            'street_type' => $this->street_type,
            'street_name' => $this->street_name,
            'dom' => $this->dom,
            'korpus' => $this->korpus,
            'office' => $this->office,
            'city_name' => $this->city_name,
            'city_guid' => $this->city_guid,
            'otdel_number' => $this->otdel_number,
            'otdel_guid' => $this->otdel_guid,
            'additional_data' => $this->additional_data,
            'updated_at' => $this->updated_at,
        ];
    }
}
