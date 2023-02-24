<?php

namespace App\Traits;

trait WithMultipleKeysScopes
{
    public function scopeWhereAtLeastIdSiteOr1C($query, $id_site, $id_1c)
    {
        $query
            ->where('id', (int)$id_site ?? 0)
            ->when(!empty($id_1c), fn($q) => $q->orWhere('id_1c', $id_1c));
    }

}
