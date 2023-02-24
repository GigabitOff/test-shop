<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReserveResource extends JsonResource
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
            'reserve' => $this->reserve,
            'reserve_minutes' => $this->reserve_minutes,
        ];
    }

}
