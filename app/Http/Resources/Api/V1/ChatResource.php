<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'owner_id' => $this->owner_id,
            'manager_id' => $this->manager_id,
            'message' => $this->message,
              //", # сайтовый идентификатор адреса из справочника доставки (через запятую, если несколько значений)
            'updated_at' => $this->updated_at,
        ];
    }

    

}
