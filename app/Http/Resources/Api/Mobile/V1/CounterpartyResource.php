<?php

namespace App\Http\Resources\Api\Mobile\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CounterpartyResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'edrpou' => $this->okpo,
            'nds' => $this->is_nds,
            'contracts' => ContractResource::collection($this->contracts)
        ];
    }
}
