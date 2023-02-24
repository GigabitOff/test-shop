<?php

namespace App\Http\Resources\Api\Mobile\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id_site' => $this->id,
            'id_1c' => $this->id_1c,
            'fio' => $this->name,
            'phone' => $this->phone,
            'is_active' => (bool) $this->is_active,
            'payment_type_id' => $this->payment_type_id,
        ];
    }
}
