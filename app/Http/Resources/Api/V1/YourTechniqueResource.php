<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class YourTechniqueResource extends JsonResource
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
            'customer_id_1c' => $this->customer->id_1c,
            'product_id_1c' => $this->product->id_1c,
            'price' => $this->price,
            'updated_at' => $this->updated_at,
        ];
    }
}
