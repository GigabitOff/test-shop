<?php

namespace App\Traits;

trait HasUserTypesAttributes
{
    /** Attributes */

    /** By Customer */

    public function getIsCustomerLegalAdminAttribute(): bool
    {
        return $this->hasRole('legal')
            && $this->is_admin
            && !$this->legal_deleted;
    }

    public function getIsCustomerLegalUserAttribute(): bool
    {
        return $this->hasRole('legal')
            && !$this->is_admin
            && !$this->legal_deleted;
    }

    public function getIsCustomerLegalAttribute(): bool
    {
        return $this->hasRole('legal')
            && !$this->legal_deleted;
    }

    public function getIsCustomerLegalDeletedAttribute(): bool
    {
        return $this->hasRole('legal') && $this->legal_deleted;
    }

    public function getIsCustomerAttribute(): bool
    {
        //return $this->hasRole('customer');
        return $this->hasRole(['simple','legal', 'unregistered']);
    }

    public function getIsCustomerUnregisteredAttribute(): bool
    {
        return $this->hasRole('unregistered');
    }

    public function getIsCustomerRegisteredAttribute(): bool
    {
        return $this->hasRole(['simple', 'legal']);
    }

    public function getIsCustomerSimpleAttribute(): bool
    {
        return $this->hasRole('simple')|| $this->isCustomerLegalDeleted;
    }

    /**
     * Возвращает истинно "простых" пользователей
     * Если админ-контрагента удаляет пользователя, то он просто помечается как удаленнй
     * @return bool
     */
    public function getIsCustomerTrueSimpleAttribute(): bool
    {
        return $this->hasRole('simple');
    }

    /** By Company Employees */

    public function getIsSiteAdminAttribute(): bool
    {
        return $this->hasRole('admin');
    }

    public function getIsManagerAttribute(): bool
    {
        return $this->hasRole('manager');
    }

    public function getIsHeadManagerAttribute(): bool
    {
        return $this->hasRole('head_manager');
    }

    public function getIsApiManagerAttribute(): bool
    {
        return $this->hasRole('api_manager');
    }

    public function getIsDirectorAttribute(): bool
    {
        return $this->hasRole('director');
    }

    public function getIsEmployeeAttribute(): bool
    {
        return $this->hasRole(['director', 'api_manager', 'head_manager', 'manager', 'admin']);
    }

    public function setCustomerTypeSimple()
    {
        $this->assignRole('simple');
    }

    public function setCustomerTypeLegal()
    {
        $this->assignRole('legal');
    }

}
