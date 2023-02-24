<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_1c' => $this->id_1c,
            'quantity' => $this->pivot->quantity,
            'price_nds' => $this->pivot->price_nds,
            'total_nds' => $this->pivot->total_nds,
            'reason' => $this->pivot->reason,
        ];
    }
}
