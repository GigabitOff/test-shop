<?php

namespace App\Http\Requests\Api\Mobile\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SetUserDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = auth()->user();
        $availableTypes = $user
            ? $user->availablePaymentTypes()->pluck('id')->toArray()
            : [];

        return [
            'name' => 'required|min:3',
            'phone' => 'required|digits:12',
            'email' => 'nullable|email',
            'payment_type_id' => [
                'nullable',
                Rule::exists('payment_types', 'id')
                    ->when($availableTypes, fn($q) => $q->whereIn('id', $availableTypes))
            ]
        ];
    }
}
