<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryTypeResource extends JsonResource
{
    protected $locales;

    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->locales = collect(config('translatable.locales', []));
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_site' => $this->id,
            'id_1c' => $this->id_1c,
            'name' => $this->getTranslates('name'),
        ];
    }

    protected function getTranslates($field){
        $langs = [];
        foreach ($this->locales as $locale){
            $langs[$locale] = ($this->translate($locale)->{$field}) ?? null;
        }

        return $langs;
    }
}
