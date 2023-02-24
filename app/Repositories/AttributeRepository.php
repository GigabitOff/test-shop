<?php

namespace App\Repositories;

use App\Models\Attribute;

class AttributeRepository
{
    private array $cache = [];

    public function getAttribute($attribute_id): ?Attribute
    {
        if (!(int)$attribute_id) {
            return null;
        }

        $hash = $this->getHash([(int)$attribute_id]);

        if (empty($this->cache[$hash])){
            $this->cache[$hash] = Attribute::find((int)$attribute_id);
        }

        return $this->cache[$hash];
    }

    private function getHash(array $data): string
    {
        return md5(json_encode($data));
    }
}
