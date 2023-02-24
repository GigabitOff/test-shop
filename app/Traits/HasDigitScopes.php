<?php

namespace App\Traits;

trait HasDigitScopes
{
    public function scopeWhereDigitFieldLike($query, $field, $value)
    {
        $clean = preg_replace('/[^\d%]/', '', $value);
        $filled = (bool) str_replace('%', '', $clean);
        if (!$filled && $field){
            $query->where($field, 'like', $clean);
        }
    }

    public function scopeOrWhereDigitFieldLike($query, $field, $value)
    {
        $clean = preg_replace('/[^\d%]/', '', $value);
        $filled = (bool) str_replace('%', '', $clean);
        if ($filled && $field){
            $query->orWhere($field, 'like', $clean);
        }
    }

}
