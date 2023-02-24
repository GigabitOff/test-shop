<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'price' => $this->pivot->price,
            'reserve' => $this->pivot->reserve,
            'options' => $this->pivot->options,
        ];
    }
}
