<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasManagerScopes
{

    public function scopeWhereUserId($query, $id)
    {
        $query->whereId($id);
    }

    public function scopeWhereUserName($query, $value)
    {
        $query->whereTranslation('name', $value);
    }

    public function scopeWhereUserNameLike($query, $value)
    {
        $query->whereTranslationLike('name', $value);
    }

    public function scopeWhereUserPosition($query, $value)
    {
        $query->where('position', $value);
    }

    public function scopeOnlyNew($query)
    {
        $query->where('created_at', '>=', (Carbon::now())->subDay(7));
    }

    public function scopeWhereUserRoleId($query, $role)
    {
        $query->role($role);
    }

    /**
     * Выбирает пользователей по типу
     * @param $query
     * @param array $type
     * @return void
     */
    public function scopeWhereCustomerType($query, $type)
    {
        switch ($type){
            case 'unregistered':
                $query->role('unregistered');
                break;
            case 'simple':
                $query->role('simple');
                break;
            case 'legal':
                $query->role('legal');
                break;
            case 'legal_admin':
                $query->role('legal');
                $query->where('is_admin', true);
                break;
            case 'legal_user':
                $query->role('legal');
                $query->where('is_admin', false);
                break;
        }
    }

    public function scopeOnlyRegistered($query)
    {
        $query->role(['simple', 'legal']);
    }

    public function scopeOnlyUnRegistered($query)
    {
        $query->role('unregistered');
    }

    public function scopeWhereUserOrdersDateFrom($query, $from)
    {
        $valid_date = strtotime($from ?? '');
        $date_at = $valid_date ? date('Y-m-d', $valid_date) : null;
        if ($date_at) {
            $query->whereHas('orders', function ($q) use ($date_at) {
                $q->where('created_at', '>=', $date_at);
            });
        }
    }

    public function scopeWhereUserOrdersDateTo($query, $to)
    {
        $valid_date = strtotime($to ?? '');
        $date_at = $valid_date ? date('Y-m-d', $valid_date) : null;
        if ($date_at) {
            $query->whereHas('orders', function ($q) use ($date_at) {
                $q->where('created_at', '<=', $date_at);
            });
        }
    }

    public function scopeWhereCounterpartyId($query, $id)
    {
        $query->whereHas('counterparties', function ($q) use ($id) {
            $q->whereId($id);
        });
    }

    public function scopeWhereCounterpartyModeration($query, $status)
    {
        $query->whereHas('counterparty', function ($q) use ($status) {
            $q->where('moderated', (bool)$status);
        });
    }

    public function scopeWhereCounterpartyType($query, $id)
    {
        $query->whereHas('counterparty', function ($q) use ($id) {
            $q->where('type_id', $id);
        });
    }

    public function scopeWhereContractId($query, $id)
    {
        $query->whereHas('contracts', function ($q) use ($id) {
            $q->whereId($id);
        });
    }

    public function scopeHasChanges($query)
    {
        $query->has('changes');
    }

}
