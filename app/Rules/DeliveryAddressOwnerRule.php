<?php

namespace App\Rules;

use App\Models\Contract;
use App\Models\Counterparty;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

class DeliveryAddressOwnerRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $query = $value['is_counterparty']
            ? Counterparty::query()
            : User::query();

        return $query
            ->where('id', (int)$value['id_site'])
            ->when($value['id_1c'], fn($q) => $q->orWhere('id_1c', $value['id_1c']))
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get( 'validation.import.delivery.owner');
    }
}
