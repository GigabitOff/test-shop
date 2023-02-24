<?php

namespace App\Traits;

trait HasCustomerScopes
{

    public function scopeOnModeration($query)
    {
        $query->where('moderated', false);
    }

    public function scopeWhereSimpleCustomer($query)
    {
        $query->role('simple');
    }

    public function scopeWhereLegalCustomer($query)
    {
        $query->role('legal');
    }

    public function scopeWhereLegalAdminCustomer($query)
    {
        $query->role('legal')
            ->where('is_admin', true);
    }

    public function scopeWhereLegalUserCustomer($query)
    {
        $query->role('legal')
            ->where('is_admin', false);
    }

    public function scopeOnlyLegalDeleted($query)
    {
        $query->where('legal_deleted', true);
    }

    public function scopeWithoutLegalDeleted($query)
    {
        $query->where('legal_deleted', false);
    }

    /**
     * Получение списка всех братских админов (с текущим)
     *
     * @param $query
     * @return mixed
     */
    public function scopeSiblingAdmins($query)
    {
        $sub = $this->counterparties()->select('id')->toRawSql();
        return $query->newQuery()
            ->where('is_admin', true)
            ->whereHas('counterparties', fn($q) => $q->whereInRaw('id', $sub));
    }


}
