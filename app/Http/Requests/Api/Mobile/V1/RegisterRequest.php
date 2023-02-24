<?php

namespace App\Http\Requests\Api\Mobile\V1;

use App\Rules\EdrpouInnRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'phone' => 'required|digits:12|unique:users,phone',
            'password' => 'required|min:6',
            'email' => 'nullable|email',
            'city_id' => 'required|exists:cities,id',
        ];

        if (!empty($this->get('company_name'))){
            $rules['company_name'] = 'required|min:3';
            $rules['edrpou'] = ['nullable', 'min:8', 'max:10', new EdrpouInnRule];
            $rules['nds'] = 'required';
        }
        return $rules;
    }
}
