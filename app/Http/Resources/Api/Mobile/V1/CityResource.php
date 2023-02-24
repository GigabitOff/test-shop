<?php

namespace App\Http\Resources\Api\Mobile\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'koatuu' => $this->koatuu,
            'name' => $this->name_uk,
            'district' => $this->district_uk,
            'region' => $this->region_uk,
        ];
    }
}
