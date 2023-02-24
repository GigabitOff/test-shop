<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'id_site' => $this->id,
            'id_1c' => $this->id_1c ?? '',
            'order_id_site' => $this->order_id,
            'order_id_1c' => $this->order->id_1c ?? '',
            'type' => $this->type,
            'status' => $this->status ?? '',
            'registry_no' => $this->registry_no ?? '',
            'date' => $this->date_at ?? '',
            'related_id' => $this->related_id ?? '',
            'related_date' => $this->related_date ?? '',
            'customer_doc_id' => $this->customer_doc_id ?? '',
            'customer_doc_date' => $this->customer_doc_date ?? '',
            'response' => $this->response ?? '',
            'counterparty_okpo' => $this->counterparty_okpo ?? '',
            'delivery_address_id' => $this->delivery_address_id ?? '',
            'storage_id_1c' => $this->storage_id_1c ?? '',
            'total_with_nds' => $this->total_with_nds,
            'updated_at' => $this->updated_at,

            'products' => DocumentProductResource::collection($this->products),
        ];
    }
}
